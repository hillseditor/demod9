Create Drupal module
  1. name the module “custom_page”

Have this module create a page with a unique URL
  1. The module must create a preage that can be navigreated to once itʼs turned on.
  2. Please use the URL “/my-preage”
  3. You will need to setup a routing file for this URL
  4. Make sure the page has a title

Have the page load a twig template from the module
  1. The twig file must reside in a directory called /templates
  2. It must be named page--my-page.html.twig
  3. You will need to use hook_theme() to have Drupal recognize the twig template.
  4. Have the page template load text in the content area. 
    1. Use the two paragraphs of latin filler text from this page:
      https://loremipsum.io/generator/?n=2&t=p
        Do: THe API was not work and I use http://loripsum.net/api/
Create an admin page for this module
  1. The admin page should be reachable from the module list page by clicking the “Configure” cog in the module “Extend” list
Make the page title and the content text area of your template found at “/mypage” editable from the admin page
  1. You should have one form field for the title and another form field for the content area. The content area can be a simple text area.
  2. When editing this page and saving it, the content should be saved and viewable at “/my-page”. 
Load a custom CSS and JavaScript file from your library in the module
  1. Make sure your module is loading the CSS from itʼs /css directory and the JavaScript from itʼs /js directory.
  2. These files should only render on the page /my-page and not on every page throughout the site
  3. The files can do anything of your choice or be empty. You may wish to style this page differently with the css file or execute some Javascript from the js file. Either way, please assure that all CSS and JavaScript is formatted properly.