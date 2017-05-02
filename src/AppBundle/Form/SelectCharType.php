<?php 
namespace AppBundle\Form;

use AppBundle\Entity\Characters;
use AppBundle\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class SelectCharType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder->add('active_char', EntityType::class, array(
            'label' => 'Personnages:',
            'class' => 'AppBundle:Characters',
            'choice_label' => 'name',
            'expanded' => false,
            'query_builder' => function (EntityRepository $er) use($options) {
                return $er->createQueryBuilder('c')
                        ->where('c.user = :id_user')
                        ->setParameter('id_user', $options['id'])
                        ->orderBy('c.name', 'ASC')
                ;
            }));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => User::class,
        ));
        $resolver->setRequired('id');
    }
}