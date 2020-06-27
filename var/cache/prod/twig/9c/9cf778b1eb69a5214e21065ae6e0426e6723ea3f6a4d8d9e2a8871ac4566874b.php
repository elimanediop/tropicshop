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

/* footer.html.twig */
class __TwigTemplate_4f72e4028b4691f577ad0bb304d007eaadcae0bb19f3e4bdfb7e8a08a6c5cb72 extends Template
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
        echo "<!-- ##### Footer Area Start ##### -->
<footer class=\"footer-area\">
    <div class=\"container\">
        <div class=\"row\">
            <!-- Footer Widget Area -->
            <div class=\"col-12 col-sm-6 col-lg-3\">
                <div class=\"footer-widget\">
                    <!-- Logo -->
                    <a href=\"index.php\" class=\"foo-logo\"><img src=\"";
        // line 9
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("img/logo_noir.png"), "html", null, true);
        echo "\" alt=\"\"></a>
                    <div class=\"footer-social-info\">
                        <a href=\"http://www.facebook.com/tropicshopofficiel\" class=\"facebook\" target=\"_blank\"><i class=\"fa fa-facebook\"></i></a>
                        <a href=\"https://www.instagram.com/tropicshop2020/\" class=\"instagram\" target=\"_blank\"><i class=\"fa fa-instagram\"></i></a>
                        <a href=\"https://www.linkedin.com/company/49104912/admin/\" class=\"linkedin\" target=\"_blank\"><i class=\"fa fa-linkedin\"></i></a>
                    </div>
                </div>
            </div>

            <!-- Footer Widget Area -->
            <div class=\"col-12 col-sm-6 col-lg-3\">

            </div>

            <!-- Footer Widget Area -->
            <div class=\"col-12 col-sm-6 col-lg-3\">

            </div>

            <!-- Footer Widget Area -->
            <div class=\"col-12 col-sm-6 col-lg-3\">
                <div class=\"footer-widget\">
                    <h6 class=\"widget-title\">Liens</h6>
                    <ul class=\"footer-tags\">
                        <li><a href=\"#\">Plan du Site</a></li>
                        <li><a href=\"#\">Mention Legale</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Copywrite Area -->
    <div class=\"copywrite-area\">
        <div class=\"container\">
            <div class=\"row\">
                <!-- Copywrite Text -->
                <div class=\"col-12 col-sm-6\">
                    <p class=\"copywrite-text\">
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        Copyright &copy;<script></script>
                        All rights reserved
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
                </div>
                <div class=\"col-12 col-sm-6\">
                    <nav class=\"footer-nav\">
                        <ul>
                            <li><a href=\"#\">Home</a></li>
                            <li><a href=\"#\">Promotion du moment</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</footer>
        <!-- ##### Footer Area End ##### -->";
    }

    public function getTemplateName()
    {
        return "footer.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  47 => 9,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "footer.html.twig", "C:\\Users\\user\\Desktop\\projet tropicshop\\codes sources\\version_1\\tropicshop\\templates\\footer.html.twig");
    }
}
