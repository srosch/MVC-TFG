How to implement a simple Registration Form with MongoDB
========================================================

Some forms have extra fields whose values don't need to be stored in the
database. In this example, we'll create a registration form with some extra
fields and (like a "terms accepted" checkbox field) and embed the form that
actually stores the account information. We'll use MongoDB for storing the data.

The simple User model
---------------------

So, in this tutorial we begin with the model for a ``User`` document:

.. code-block:: php

    // src/Acme/AccountBundle/Document/User.php
    namespace Acme\AccountBundle\Document;

    use Doctrine\Bundle\MongoDBBundle\Validator\Constraints\Unique as MongoDBUnique;
    use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
    use Symfony\Component\Validator\Constraints as Assert;

    /**
     * @MongoDB\Document(collection="users")
     * @MongoDBUnique(fields="email")
     */
    class User
    {
        /**
         * @MongoDB\Id
         */
        protected $id;

        /**
         * @MongoDB\Field(type="string")
         * @Assert\NotBlank()
         * @Assert\Email()
         */
        protected $email;

        /**
         * @MongoDB\Field(type="string")
         * @Assert\NotBlank()
         */
        protected $password;

        public function getId()
        {
            return $this->id;
        }

        public function getEmail()
        {
            return $this->email;
        }

        public function setEmail($email)
        {
            $this->email = $email;
        }

        public function getPassword()
        {
            return $this->password;
        }

        // stupid simple encryption (please don't copy it!)
        public function setPassword($password)
        {
            $this->password = sha1($password);
        }
    }

This ``User`` document contains three fields and two of them (email and
password) should display on the form. The email property must be unique
on the database, so we've added this validation at the top of the class.

.. note::

    If you want to integrate this User within the security system,you need
    to implement the `UserInterface`_ of the security component.

Create a Form for the Model
---------------------------

Next, create the form for the ``User`` model:

.. code-block:: php

    // src/Acme/AccountBundle/Form/Type/UserType.php
    namespace Acme\AccountBundle\Form\Type;

    use Acme\AccountBundle\Document\User;
    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\Extension\Core\Type\EmailType;
    use Symfony\Component\Form\Extension\Core\Type\PasswordType;
    use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\OptionsResolver\OptionsResolver;

    class UserType extends AbstractType
    {
        public function buildForm(FormBuilderInterface $builder, array $options)
        {
            $builder->add('email', EmailType::class);
            $builder->add('password', RepeatedType::class, [
                'first_name' => 'password',
                'second_name' => 'confirm',
                'type' => PasswordType::class
            ]);
        }

        public function configureOptions(OptionsResolver $resolver)
        {
            $resolver->setDefaults([
                'data_class' => User::class,
            ]);
        }
    }

We just added two fields: email and password (repeated to confirm the entered
password). The ``data_class`` option tells the form the name of data class
(i.e. your ``User`` document).

.. tip::

    To explore more things about form component, read this documentation `file`_.

Embedding the User form into a Registration Form
------------------------------------------------

The form that you'll use for the registration page is not the same as the
form for used to simply modify the ``User`` (i.e. ``UserType``). The registration
form will contain further fields like "accept the terms", whose value is
won't be stored into database.

In other words, create a second form for registration, which embeds the ``User``
form and adds the extra field needed. Start by creating a simple class which
represents the "registration":

.. code-block:: php

    // src/Acme/AccountBundle/Form/Model/Registration.php
    namespace Acme\AccountBundle\Form\Model;

    use Acme\AccountBundle\Document\User;
    use Symfony\Component\Validator\Constraints as Assert;

    class Registration
    {
        /**
         * @Assert\Type(type="Acme\AccountBundle\Document\User")
         */
        protected $user;

        /**
         * @Assert\NotBlank()
         * @Assert\True()
         */
        protected $termsAccepted;

        public function setUser(User $user)
        {
            $this->user = $user;
        }

        public function getUser()
        {
            return $this->user;
        }

        public function getTermsAccepted()
        {
            return $this->termsAccepted;
        }

        public function setTermsAccepted($termsAccepted)
        {
            $this->termsAccepted = (boolean)$termsAccepted;
        }
    }

Next, create the form for this ``Registration`` model:

.. code-block:: php

    // src/Acme/AccountBundle/Form/Type/RegistrationType.php
    namespace Acme\AccountBundle\Form\Type;

    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\Extension\Core\Type\CheckboxType
    use Symfony\Component\Form\FormBuilderInterface;

    class RegistrationType extends AbstractType
    {
        public function buildForm(FormBuilderInterface $builder, array $options)
        {
            $builder->add('user', UserType::class);
            $builder->add('terms', CheckboxType::class, ['property_path' => 'termsAccepted']);
        }
    }

You don't need to use special method for embedding the ``UserType`` form.
A form is a field, too - so you can add this like any other field, with the
expectation that the corresponding ``user`` property will hold an instance
of the class ``UserType``.

Handling the Form Submission
----------------------------

Next, you need a controller to handle the form. Start by creating a simple
controller for displaying the registration form:

.. code-block:: php

    // src/Acme/AccountBundle/Controller/AccountController.php
    namespace Acme\AccountBundle\Controller;

    use Acme\AccountBundle\Form\Model\Registration;
    use Acme\AccountBundle\Form\Type\RegistrationType;
    use Symfony\Bundle\FrameworkBundle\Controller\Controller;
    use Symfony\Component\HttpFoundation\Response;

    class AccountController extends Controller
    {
        public function registerAction()
        {
            $form = $this->createForm(RegistrationType::class, new Registration());

            return $this->render('AcmeAccountBundle:Account:register.html.twig', ['form' => $form->createView()]);
        }
    }

and its template:

.. code-block:: html+jinja

    {# src/Acme/AccountBundle/Resources/views/Account/register.html.twig #}
    <form action="{{ path('create')}}" method="post" {{ form_enctype(form) }}>
        {{ form_widget(form) }}

        <input type="submit" />
    </form>

Finally, create the controller which handles the form submission.  This performs
the validation and saves the data into MongoDB:

.. code-block:: php

    public function createAction(Request $request)
    {
        $dm = $this->get('doctrine_mongodb')->getManager();

        $form = $this->createForm(new RegistrationType(), new Registration());

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $registration = $form->getData();

            $dm->persist($registration->getUser());
            $dm->flush();

            return $this->redirect(...);
        }

        return $this->render('AcmeAccountBundle:Account:register.html.twig', ['form' => $form->createView()]);
    }

That's it! Your form now validates, and allows you to save the ``User``
object to MongoDB.

.. _`UserInterface`: http://symfony.com/doc/current/book/security.html#book-security-user-entity
.. _`file`: http://symfony.com/doc/current/book/forms.html
