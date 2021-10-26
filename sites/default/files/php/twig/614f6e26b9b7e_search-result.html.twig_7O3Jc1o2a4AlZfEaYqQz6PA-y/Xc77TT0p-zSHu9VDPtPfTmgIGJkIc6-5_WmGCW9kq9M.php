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

/* core/themes/olivero/templates/content/search-result.html.twig */
class __TwigTemplate_d191e9241637b665fb162ba18646d98bef5ef71a8bd692cd33e05700e2e612f7 extends \Twig\Template
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
        // line 58
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->extensions['Drupal\Core\Template\TwigExtension']->attachLibrary("olivero/search-results"), "html", null, true);
        echo "
";
        // line 59
        if (($context["info_split"] ?? null)) {
            // line 60
            echo "  <div class=\"search-result__meta\">
    ";
            // line 61
            if (twig_get_attribute($this->env, $this->source, ($context["info_split"] ?? null), "user", [], "any", false, false, true, 61)) {
                // line 62
                echo "      <span>
        ";
                // line 63
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("By"));
                echo " ";
                ob_start(function () { return ''; });
                echo "<span class=\"search-result__author\">";
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["info_split"] ?? null), "user", [], "any", false, false, true, 63), 63, $this->source), "html", null, true);
                echo "</span>";
                $___internal_c960be195ce598f9d6c7c53dc8bf43781e2ea19430945db3758b001acc049515_ = ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(twig_spaceless($___internal_c960be195ce598f9d6c7c53dc8bf43781e2ea19430945db3758b001acc049515_));
                // line 64
                echo "      </span>
    ";
            }
            // line 66
            echo "    ";
            if (($context["info_date"] ?? null)) {
                // line 67
                echo "      <span  class=\"search-result__date\">, ";
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["info_date"] ?? null), 67, $this->source), "html", null, true);
                echo "</span>
    ";
            }
            // line 69
            echo "  </div>
";
        }
        // line 71
        if (($context["title"] ?? null)) {
            // line 72
            echo "  ";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["title_prefix"] ?? null), 72, $this->source), "html", null, true);
            echo "
  <h3";
            // line 73
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["title_attributes"] ?? null), "addClass", [0 => "search-result__title"], "method", false, false, true, 73), 73, $this->source), "html", null, true);
            echo ">
    <a href=\"";
            // line 74
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["url"] ?? null), 74, $this->source), "html", null, true);
            echo "\">";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["title"] ?? null), 74, $this->source), "html", null, true);
            echo "</a>
  </h3>
  ";
            // line 76
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["title_suffix"] ?? null), 76, $this->source), "html", null, true);
            echo "
";
        }
        // line 78
        if (($context["snippet"] ?? null)) {
            // line 79
            echo "  <div";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["content_attributes"] ?? null), "addClass", [0 => "search-result__snippet", 1 => ($context["layout"] ?? null), 2 => "text-content"], "method", false, false, true, 79), 79, $this->source), "html", null, true);
            echo ">";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["snippet"] ?? null), 79, $this->source), "html", null, true);
            echo "</div>
";
        }
    }

    public function getTemplateName()
    {
        return "core/themes/olivero/templates/content/search-result.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  104 => 79,  102 => 78,  97 => 76,  90 => 74,  86 => 73,  81 => 72,  79 => 71,  75 => 69,  69 => 67,  66 => 66,  62 => 64,  53 => 63,  50 => 62,  48 => 61,  45 => 60,  43 => 59,  39 => 58,);
    }

    public function getSourceContext()
    {
        return new Source("", "core/themes/olivero/templates/content/search-result.html.twig", "/home/mavsinjapan/public_html/core/themes/olivero/templates/content/search-result.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("if" => 59, "apply" => 63);
        static $filters = array("escape" => 58, "t" => 63, "spaceless" => 63);
        static $functions = array("attach_library" => 58);

        try {
            $this->sandbox->checkSecurity(
                ['if', 'apply'],
                ['escape', 't', 'spaceless'],
                ['attach_library']
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
