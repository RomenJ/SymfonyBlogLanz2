<?php
/**VERSIÓN CON IMPLEMENTACIÓN DE CHAT GPT3 */
namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Security\Core\Security;

class UserType extends AbstractType
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $entity = $builder->getData();

        $builder
            ->add('username')
            ->add('email')
            ->add('avatar', FileType::class, [
                'label' => 'Elija un avatar chulo subiendo una foto desde su ordenador',
                'mapped' => false,
                'required' => false,
            ])
            ->add('roles', ChoiceType::class, [
                'choices' => [
                    'User' => 'ROLE_USER',
                    'Admin' => 'ROLE_ADMIN',
                ],
                'expanded' => true,
                'multiple' => true,
                'data' => $entity->getRoles(),
                'choice_attr' => function ($choice, $key, $value) {
                    // Solo los usuarios con el rol 'ROLE_ADMIN' podrán seleccionar 'Admin'
                    if ($value === 'ROLE_ADMIN') {
                        if (!$this->security->isGranted('ROLE_ADMIN')) {
                            return ['disabled' => 'disabled'];
                        }
                    }
                    return [];
                },
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}




/* versión sin implementación de chat GPT3
namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        
//Importante
$entity = $builder->getData();

$builder
    ->add('username')
    ->add('email')
    ->add('avatar',FileType::class, [
        'label' => 'Elija un avatar chulo subiendo una foto de su ordenador',

        // unmapped means that this field is not associated to any entity property
        'mapped' => false,

        // make it optional so you don't have to re-upload the PDF file
        // every time you edit the Product details
        'required' => false,

        // unmapped fields can't define their validation using annotations
        // in the associated entity, so you can use the PHP constraint classes
      
    ])
  
    ->add('roles', ChoiceType::class, [
        'choices' => [
            'User' => 'ROLE_USER',
            'Admin' => 'ROLE_ADMIN',
        ],
        'expanded' => true,
        'multiple' => true,
        'data' => $entity->getRoles() // Current roles assigned..
    ])
;


    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
*/