<?php

namespace App\Controller\Admin;

use App\Entity\Boutique;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\RedirectResponse;

class BoutiqueCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Boutique::class;
    }
    public function configureFields(string $pageName): iterable
    {

        yield TextField::new('titre')
            ->setLabel('Titre (Maximum 20 caractères)');
        yield TextField::new('link')
            ->setLabel('Link de l\'annonce');
        yield TextField::new('prix')
            ->setLabel('Prix');
        if ($pageName === Crud::PAGE_NEW){
            yield ImageField::new('img', 'Image')
                ->setUploadedFileNamePattern('[slug]-[contenthash].[extension]')
                ->setUploadDir('public/uploads/img')
                ->setBasePath('uploads/img')
                ->setRequired(true);
        }else{
            yield ImageField::new('img', 'Image')
                ->setUploadedFileNamePattern('[slug]-[contenthash].[extension]')
                ->setUploadDir('public/uploads/img')
                ->setBasePath('uploads/img');
        }

    }


    /**
     * @param AdminContext $context
     * @param string $action
     * @return RedirectResponse
     */
    protected function getRedirectResponseAfterSave(AdminContext $context, string $action): RedirectResponse
    {
        /**
         * @var $entityInstance Boutique
         */
        $entityInstance = $context->getEntity()->getInstance();

        $image = $entityInstance->getImg();
        if (!isset($image)){
            $adminurlgenerator = $this->get(AdminUrlGenerator::class);
            $this->addFlash('warning', 'merci de mettre une image');
            return $this->redirect($adminurlgenerator->setController(BoutiqueCrudController::class)->setAction('edit')->setEntityId($entityInstance->getId())->generateUrl());
        }
        return parent::getRedirectResponseAfterSave($context, $action);
    }
}
