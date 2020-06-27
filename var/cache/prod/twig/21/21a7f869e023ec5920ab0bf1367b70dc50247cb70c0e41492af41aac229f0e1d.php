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

/* header.html.twig */
class __TwigTemplate_4955bdab6a194d8289a9d8edb0900192218594d943f29a2a7ba9f379ab5ddf23 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 1
        echo "<!-- Preloader -->
<div class=\"preloader d-flex align-items-center justify-content-center\">
    <div class=\"spinner\">
        <div class=\"double-bounce1\"></div>
        <div class=\"double-bounce2\"></div>
    </div>
</div>
        <!-- ##### Header Area Start ##### -->
<header class=\"header-area\">

<!-- Navbar Area -->
<div class=\"mag-main-menu\" id=\"sticker\">
    <div class=\"classy-nav-container breakpoint-off\">
        <!-- Menu -->
        <nav class=\"classy-navbar justify-content-between\" id=\"magNav\">

            <!-- Nav brand -->
            <a href=\"index.php\" class=\"nav-brand\"><img src=\"";
        // line 18
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("img/logo.png"), "html", null, true);
        echo "\" alt=\"\"></a>

            <!-- Navbar Toggler -->
            <div class=\"classy-navbar-toggler\">
                <span class=\"navbarToggler\"><span></span><span></span><span></span></span>
            </div>

            <!-- Nav Content -->
            <div class=\"nav-content d-flex align-items-center\">
                <div class=\"classy-menu\">

                    <!-- Close Button -->
                    <div class=\"classycloseIcon\">
                        <div class=\"cross-wrap\"><span class=\"top\"></span><span class=\"bottom\"></span></div>
                    </div>

                    <!-- Nav Start -->
                    <div class=\"classynav\">
                        <ul>
                            <li class=\"active\"><a href=\"index.php\">Home</a></li>
                            <li><a href=\"promo.php\">Promotion du moment</a></li>
                        </ul>
                        <!-- Top Search Area -->
                        <div class=\"top-search-area\">
                            <form id=\"formSearch\" action=\"index.php\" method=\"post\">
                                <input type=\"search\" name=\"top-search\" id=\"topSearch\"
                                       placeholder=\"Rechercher un produit...\">
                                <button type=\"submit\" class=\"btn\"><i class=\"fa fa-search\" aria-hidden=\"true\"></i>
                                </button>
                            </form>
                        </div>
                        <div class=\"top-search-area\">
                            <form id=\"formMap\" action=\"magasins.php\" method=\"post\">
                                <input type=\"text\" name=\"top-map\"  id=\"topMap\"
                                       placeholder=\"Où voulez-vous être livré?\">
                                <button type=\"submit\" class=\"btn\"><i class=\"fa fa-map-marker\"                                                               aria-hidden=\"true\"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                    <!-- Nav End -->
                </div>

                <div class=\"top-meta-data d-flex align-items-center\">
                    <!-- Login -->
                    <a href=\"";
        // line 63
        echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("security_login");
        echo "\" class=\"login-btn\"><i class=\"fa fa-user\" aria-hidden=\"true\"></i></a>
                </div>
                <div class=\"top-meta-data d-flex align-items-center\">
                    <!-- Login -->
                    <a href=\"panier.php\" class=\"login-btn\"><i class=\"fa fa-shopping-cart\"
                                                              aria-hidden=\"true\"></i></a>
                </div>
            </div>
        </nav>
    </div>
</div>
</header>
        <!-- ##### Header Area End ##### -->
";
    }

    public function getTemplateName()
    {
        return "header.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  104 => 63,  56 => 18,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "header.html.twig", "C:\\Users\\user\\Desktop\\projet tropicshop\\codes sources\\version_1\\tropicshop\\templates\\header.html.twig");
    }
}
