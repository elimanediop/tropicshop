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

/* security/login.html.twig */
class __TwigTemplate_30dc552ca55777bb0402d80c18c267a87454f73d22b61f782243ffcf35cfaeff extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'title' => [$this, 'block_title'],
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
        $this->parent = $this->loadTemplate("base.html.twig", "security/login.html.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_title($context, array $blocks = [])
    {
        $macros = $this->macros;
        echo twig_escape_filter($this->env, ($context["app_name"] ?? null), "html", null, true);
    }

    // line 5
    public function block_body($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 6
        echo "        <!-- Page Content -->
        <!-- ##### Breadcrumb Area Start ##### -->
<section class=\"breadcrumb-area bg-img bg-overlay\" style=\"background-image: url(";
        // line 8
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("img/slider2.jpg"), "html", null, true);
        echo ");\">
    <div class=\"container h-100\">
        <div class=\"row h-100 align-items-center\">
            <div class=\"col-12\">
                <div class=\"breadcrumb-content\">
                    <h2>Login</h2>
                </div>
            </div>
        </div>
    </div>
</section>
        <!-- ##### Breadcrumb Area End ##### -->


        <!-- ##### Login Area Start ##### -->
<div class=\"mag-login-area py-5 h-100\">
<div class=\"container h-100\">
    <div class=\"row h-100 justify-content-center\">
        <div class=\"col-12 col-lg-6\">
            <div class=\"login-content bg-white p-30 box-shadow\">
                <!-- Section Title -->
                <div class=\"section-heading\">
                    <h5>Content de vous revoir!</h5>
                </div>

                <form action=\"";
        // line 33
        echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("security_login");
        echo "\" method=\"post\">
                    <div class=\"form-group\">
                        <input type=\"email\" name=\"_username\" id=\"inputEmail\" class=\"form-control\"
                               placeholder=\"Mail\">
                    </div>
                    <div class=\"form-group\">
                        <input type=\"password\" class=\"form-control\" name=\"_password\" id=\"inputPassword\"
                               placeholder=\"Mot de passe\" data-toggle=\"password\">
                    </div>
                    <div class=\"form-group\">
                        <button type=\"submit\" class=\"btn mag-btn mt-30\">Login</button>
                        <a href=\"";
        // line 44
        echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("security_registration");
        echo "\" class=\"post-title\">
                            <button type=\"button\" class=\"btn mag-btn mt-30\">Inscription</button>
                        </a>
                    </div>
                    <a href=\"resetMotdepasse.html\" class=\"post-title\">
                        <label>Mot de passe Oublié?</label>
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
        return "security/login.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  104 => 44,  90 => 33,  62 => 8,  58 => 6,  54 => 5,  47 => 3,  36 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "security/login.html.twig", "C:\\Users\\user\\Desktop\\projet tropicshop\\codes sources\\version_1\\tropicshop\\templates\\security\\login.html.twig");
    }
}
