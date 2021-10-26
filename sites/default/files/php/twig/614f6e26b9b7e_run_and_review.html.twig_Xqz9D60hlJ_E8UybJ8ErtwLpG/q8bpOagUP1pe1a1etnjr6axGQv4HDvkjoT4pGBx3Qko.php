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

/* modules/security_review/templates/run_and_review.html.twig */
class __TwigTemplate_9118c91f0c6e0e68534487292dbd5cf4615d81c718c879ac18cd38bee272e6a0 extends \Twig\Template
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
        // line 16
        echo "
<h3>
    ";
        // line 18
        echo t("Review results from last run @date", array("@date" =>         // line 19
($context["date"] ?? null), ));
        // line 21
        echo "</h3>
<p>
    ";
        // line 23
        echo t("Here you can review the results from the last run of the checklist. Checks
    are not always perfectly correct in their procedure and result. You can keep
    a check from running by clicking the 'Skip' link beside it. You can run the
    checklist again by expanding the fieldset above.", array());
        // line 29
        echo "</p>
<table class=\"security-review-run-and-review__table\">
    <tbody>
    ";
        // line 32
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["checks"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["check"]) {
            // line 33
            echo "        ";
            $context["style"] = "";
            // line 34
            echo "        ";
            if (twig_get_attribute($this->env, $this->source, $context["check"], "result", [], "any", true, true, true, 34)) {
                // line 35
                echo "            ";
                $context["style"] = (($this->sandbox->ensureToStringAllowed(($context["style"] ?? null), 35, $this->source) . " ") . $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["check"], "result", [], "any", false, false, true, 35), 35, $this->source));
                // line 36
                echo "        ";
            }
            // line 37
            echo "        ";
            if (twig_get_attribute($this->env, $this->source, $context["check"], "skipped", [], "any", false, false, true, 37)) {
                // line 38
                echo "            ";
                $context["style"] = ($this->sandbox->ensureToStringAllowed(($context["style"] ?? null), 38, $this->source) . " skipped");
                // line 39
                echo "        ";
            }
            // line 40
            echo "        <tr class=\"security-review-run-and-review__entry";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["style"] ?? null), 40, $this->source), "html", null, true);
            echo "\">
            <td class=\"security-review-run-and-review__entry-icon\">
                ";
            // line 42
            if (twig_get_attribute($this->env, $this->source, ($context["icons"] ?? null), twig_get_attribute($this->env, $this->source, $context["check"], "result", [], "any", false, false, true, 42), [], "array", true, true, true, 42)) {
                // line 43
                echo "                    <img src=\"";
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed((($__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4 = ($context["icons"] ?? null)) && is_array($__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4) || $__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4 instanceof ArrayAccess ? ($__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4[twig_get_attribute($this->env, $this->source, $context["check"], "result", [], "any", false, false, true, 43)] ?? null) : null), 43, $this->source), "html", null, true);
                echo "\"/>
                ";
            }
            // line 45
            echo "            </td>
            <td>";
            // line 46
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["check"], "message", [], "any", false, false, true, 46), 46, $this->source), "html", null, true);
            echo "</td>
            <td>";
            // line 47
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["check"], "help_link", [], "any", false, false, true, 47), 47, $this->source), "html", null, true);
            echo "</td>
            <td class=\"security-review-toggle-link\">";
            // line 48
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["check"], "toggle_link", [], "any", false, false, true, 48), 48, $this->source), "html", null, true);
            echo "</td>
        </tr>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['check'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 51
        echo "    </tbody>
</table>
";
    }

    public function getTemplateName()
    {
        return "modules/security_review/templates/run_and_review.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  119 => 51,  110 => 48,  106 => 47,  102 => 46,  99 => 45,  93 => 43,  91 => 42,  85 => 40,  82 => 39,  79 => 38,  76 => 37,  73 => 36,  70 => 35,  67 => 34,  64 => 33,  60 => 32,  55 => 29,  50 => 23,  46 => 21,  44 => 19,  43 => 18,  39 => 16,);
    }

    public function getSourceContext()
    {
        return new Source("", "modules/security_review/templates/run_and_review.html.twig", "/home/sxs4805/public_html/modules/security_review/templates/run_and_review.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("trans" => 18, "for" => 32, "set" => 33, "if" => 34);
        static $filters = array("escape" => 19);
        static $functions = array();

        try {
            $this->sandbox->checkSecurity(
                ['trans', 'for', 'set', 'if'],
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
