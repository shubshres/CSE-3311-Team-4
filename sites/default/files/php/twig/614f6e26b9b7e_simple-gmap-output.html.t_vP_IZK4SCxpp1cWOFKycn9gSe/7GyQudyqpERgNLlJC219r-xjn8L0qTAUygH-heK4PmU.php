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

/* modules/simple_gmap/templates/simple-gmap-output.html.twig */
class __TwigTemplate_ec9d5378a4aa8b97cdcb6de4f505331c6e6ab28d567efe33c1268f96b69e75b1 extends \Twig\Template
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
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $this->checkSecurity();
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 30
        if (($context["include_map"] ?? null)) {
            // line 31
            echo "  ";
            $context["new_map_type"] = 0;
            // line 32
            echo "  ";
            if ((($context["map_type"] ?? null) == "k")) {
                // line 33
                echo "    ";
                $context["new_map_type"] = 1;
                // line 34
                echo "  ";
            }
            // line 35
            echo "  <iframe width=\"";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["width"] ?? null), 35, $this->source), "html", null, true);
            echo "\" height=\"";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["height"] ?? null), 35, $this->source), "html", null, true);
            echo "\" title=\"";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["iframe_title"] ?? null), 35, $this->source), "html", null, true);
            echo "\" frameborder=\"0\" style=\"border:0\" src=\"https://www.google.com/maps/embed?origin=mfe&amp;pb=!1m4!2m1!1s";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["url_suffix"] ?? null), 35, $this->source), "html", null, true);
            echo "!5e";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["new_map_type"] ?? null), 35, $this->source), "html", null, true);
            echo "!6i";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["zoom"] ?? null), 35, $this->source), "html", null, true);
            echo "!5m1!1s";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["langcode"] ?? null), 35, $this->source), "html", null, true);
            echo "\"></iframe>
";
        }
        // line 37
        if (($context["include_static_map"] ?? null)) {
            // line 38
            echo "  <div class=\"simple-gmap-static-map\">
    <img src=\"https://maps.googleapis.com/maps/api/staticmap?size=";
            // line 39
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["width"] ?? null), 39, $this->source), "html", null, true);
            echo "x";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["height"] ?? null), 39, $this->source), "html", null, true);
            echo "&amp;scale=";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["static_scale"] ?? null), 39, $this->source), "html", null, true);
            echo "&amp;zoom=";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["zoom"] ?? null), 39, $this->source), "html", null, true);
            echo "&amp;language=";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["langcode"] ?? null), 39, $this->source), "html", null, true);
            echo "&amp;maptype=";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["static_map_type"] ?? null), 39, $this->source), "html", null, true);
            echo "&amp;markers=color:red|";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["url_suffix"] ?? null), 39, $this->source), "html", null, true);
            echo "&amp;sensor=false&amp;key=";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["apikey"] ?? null), 39, $this->source), "html", null, true);
            echo "\" />
  </div>
";
        }
        // line 42
        if (($context["include_link"] ?? null)) {
            // line 43
            echo "  <p class=\"simple-gmap-link\"><a href=\"https://www.google.com/maps?q=";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["url_suffix"] ?? null), 43, $this->source), "html", null, true);
            echo "&amp;hl=";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["langcode"] ?? null), 43, $this->source), "html", null, true);
            echo "&amp;t=";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["map_type"] ?? null), 43, $this->source), "html", null, true);
            echo "&amp;z=";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["zoom"] ?? null), 43, $this->source), "html", null, true);
            echo "\" target=\"_blank\">";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["link_text"] ?? null), 43, $this->source), "html", null, true);
            echo "</a></p>
";
        }
        // line 45
        if ( !twig_test_empty(($context["address_text"] ?? null))) {
            // line 46
            echo "  <p class=\"simple-gmap-address\">";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["address_text"] ?? null), 46, $this->source), "html", null, true);
            echo "</p>
";
        }
    }

    public function getTemplateName()
    {
        return "modules/simple_gmap/templates/simple-gmap-output.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  114 => 46,  112 => 45,  98 => 43,  96 => 42,  76 => 39,  73 => 38,  71 => 37,  53 => 35,  50 => 34,  47 => 33,  44 => 32,  41 => 31,  39 => 30,);
    }

    public function getSourceContext()
    {
        return new Source("", "modules/simple_gmap/templates/simple-gmap-output.html.twig", "/home/sxs4805/public_html/modules/simple_gmap/templates/simple-gmap-output.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("if" => 30, "set" => 31);
        static $filters = array("escape" => 35);
        static $functions = array();

        try {
            $this->sandbox->checkSecurity(
                ['if', 'set'],
                ['escape'],
                []
            );
        } catch (SecurityError $e) {
            $e->setSourceContext($this->source);

            if ($e instanceof SecurityNotAllowedTagError && isset($tags[$e->getTagName()])) {
                $e->setTemplateLine($tags[$e->getTagName()]);
            } elseif ($e instanceof SecurityNotAllowedFilterError && isset($filters[$e->getFilterName()])) {
                $e->setTemplateLine($filters[$e->getFilterName()]);
            } elseif ($e instanceof SecurityNotAllowedFunctionError && isset($functions[$e->getFunctionName()])) {
                $e->setTemplateLine($functions[$e->getFunctionName()]);
            }

            throw $e;
        }

    }
}
