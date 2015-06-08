<?php

/* html_footer.html.twig */
class __TwigTemplate_2566787baa0e8b6b43f8c69def67eafa770ec566ae23f91974d47d84153b0959 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo twig_escape_filter($this->env, (isset($context["username"]) ? $context["username"] : null), "html", null, true);
        echo twig_escape_filter($this->env, (isset($context["title"]) ? $context["title"] : null), "html", null, true);
        echo "<hr>

      <footer>
        <p>&copy;  2014 </p>
      </footer>
    </div> <!-- /container -->        <script src=\"//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js\"></script>
        <script>window.jQuery || document.write('<script src=\"javascripts/jquery-1.11.0.min.js\"><\\/script>')</script>

        <script src=\"javascripts/bootstrap.js\"></script>

        <script src=\"javascripts/main.js\"></script>

    </body>
</html>
";
    }

    public function getTemplateName()
    {
        return "html_footer.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  19 => 1,);
    }
}
