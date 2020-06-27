<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* security/registration.html.twig */
class __TwigTemplate_16b2f9ba20cc0c8ad86a3fc5aede21cbe3e266a4a071672b6e1d4340dc629a31 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'body' => [$this, 'block_body'],
        ];
    }

    protected function doGetParent(array $context)
    {
        // line 1
        return "base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $this->parent = $this->loadTemplate("base.html.twig", "security/registration.html.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_body($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 4
        echo "
        <!-- ##### Breadcrumb Area Start ##### -->
<section class=\"breadcrumb-area bg-img bg-overlay\" style=\"background-image: url(";
        // line 6
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("img/slider5.jpg"), "html", null, true);
        echo ");\">
    <div class=\"container h-100\">
        <div class=\"row h-100 align-items-center\">
            <div class=\"col-12\">
                <div class=\"breadcrumb-content\">
                    <h2></h2>
                </div>
            </div>
        </div>
    </div>
</section>
        <!-- ##### Breadcrumb Area End ##### -->

        <!-- ##### Login Area Start ##### -->
<div class=\"mag-login-area py-5\">
<div class=\"container\">
    <div class=\"row justify-content-center\">
        <div class=\"col-12 col-lg-6\">
            <div class=\"login-content bg-white p-30 box-shadow\">
                <!-- Section Title -->
                <div class=\"section-heading\">
                    <h5>Renseignez-le formulaire!</h5>
                </div>

                <form action=\"index.php\" method=\"post\">
                    <div class=\"form-row\">

                        <div class=\"form-group col-md-6\">
                            <select class=\"form-control\" id=\"type_utilisateur\" required>
                                <option>Client ou Vendeur</option>
                                <option value=\"1\">Client</option>
                                <option value=\"2\">Vendeur</option>
                            </select>
                        </div>
                        <div class=\"form-group col-md-6\">
                            <input type=\"text\" class=\"form-control\" id=\"nom\" placeholder=\"Nom\" required>
                        </div>
                        <div class=\"form-group col-md-6\">
                            <input type=\"text\" class=\"form-control\" id=\"prenom\" placeholder=\"Prenom\" required>
                        </div>
                        <div class=\"form-group col-md-6\">
                            <input type=\"text\" class=\"form-control\" id=\"mail\" placeholder=\"Mail\" required>
                        </div>
                        <div class=\"form-group col-md-6\">
                            <input type=\"text\" class=\"form-control\" id=\"numTelephone\" placeholder=\"Numéro Telephone\" required>
                        </div>
                    </div>
                    <div class=\"form-group\">
                        <input type=\"text\" class=\"form-control\" id=\"adresse\" placeholder=\"Adresse\" required>
                    </div>
                    <div class=\"form-row\">
                        <div class=\"form-group col-md-6\">
                            <input type=\"text\" class=\"form-control\" id=\"codePosal\" placeholder=\"Code Postal\" required>
                        </div>
                        <div class=\"form-group col-md-6\">
                            <input type=\"text\" class=\"form-control\" id=\"ville\" placeholder=\"Ville\" required>
                        </div>
                    </div>
                    <div class=\"form-row\" id=\"idDetailMag\">
                        <div class=\"form-group col-md-6\">
                            <input type=\"text\" class=\"form-control\" id=\"nommagasin\" placeholder=\"Nom Magasin\">
                        </div>
                        <div class=\"form-group col-md-6\">
                            <input type=\"text\" class=\"form-control\" id=\"numTva\" placeholder=\"Numéros TVA\">
                        </div>
                        <div class=\"form-group col-md-6\">
                            <input type=\"text\" class=\"form-control\" id=\"numSiret\" placeholder=\"Numéros siret\">
                        </div>
                    </div>
                    <div class=\"form-row\">
                        <div class=\"form-group col-md-6\">
                            <input type=\"text\" class=\"form-control\" id=\"motDePasse\" placeholder=\"Mot de Passe\" required>
                        </div>
                        <div class=\"form-group col-md-6\">
                            <input type=\"text\" class=\"form-control\" id=\"motDePasseConfirm\" placeholder=\"Confirmer Mot de Passe\" required>
                        </div>
                    </div>

                    <button type=\"submit\" class=\"btn mag-btn mt-30\">Valider</button>
                    <a href=\"index.php\" class=\"post-title\">
                        <button type=\"button\" class=\"btn mag-btn mt-30\">Retour</button>
                    </a>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
        <!-- ##### Login Area End ##### -->
";
    }

    public function getTemplateName()
    {
        return "security/registration.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  54 => 6,  50 => 4,  46 => 3,  35 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "security/registration.html.twig", "C:\\Users\\user\\Desktop\\projet tropicshop\\codes sources\\version_1\\tropicshop\\templates\\security\\registration.html.twig");
    }
}
