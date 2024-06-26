<?php

namespace App\Form;

use App\Entity\Commune;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\Autocomplete\Form\AsEntityAutocompleteField;
use Symfony\UX\Autocomplete\Form\BaseEntityAutocompleteType;
use Symfony\Component\Validator\Constraints\Count;


#[AsEntityAutocompleteField]
class CommuneAutocompleteField extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'class' => Commune::class,
            'placeholder' => 'Choisissez une Ville ou plusieurs Villes',
            'choice_label' => 'nom',
            'searchable_fields' => ['nom'],
            'multiple' => true,
            'constraints' => [
                new Count(min: 1, minMessage: 'Vous devez sélectionner au moins une ville'),
            ],
            'query_builder' => function ($er) {
                return $er->createQueryBuilder('c')
                    ->orderBy('c.nom', 'ASC');
            },
            'required' => false,

            // 'security' => 'ROLE_SOMETHING',
        ]);
    }

    public function getParent(): string
    {
        return BaseEntityAutocompleteType::class;
    }
}
