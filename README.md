# displaypostsrestapi
WordPress plugin to display WP Posts from an external website using the REST API. 

For this Project I communicated to the REST API endpoint at the ProtonMail Blog at: https://protonmail.com/blog/


**The Process**

**01. Discover**
Original website:
https://protonmail.com/blog/

Data provided via JSON file: 
“name”: “ProtonMail Blog”,
“description”: “Secure Email News”,
“url”: “https://protonmail.com/blog”,

WP REST API: https://protonmail.com/blog/wp-json/

**02. Define the Task**
Install WordPress on an external server.

Fetch the the latest 5 Posts, including their Title, metadata, and excerpts.

In the fetched Posts we need to make sure that the displayed output links back to the original Post and Author. Also included featured images, although that wasn’t a requirement.

**03. Design**
Creation of a WordPress Child Theme, based on Astra, a lightweight, fast and developer-friendly Theme.  

Astra uses default WordPress data and coding standards to make sure that every piece of code is optimized.

More details about Astra at: https://wpastra.com/

**04. Develop**
Creation of a WordPress plugin that provides the needed functionality to communicate to the REST API endpoint at the ProtonMail Blog. 

I used GitHub as a Proof of Concept, to show how the development of WordPress plugins and Themes should be done, specially when there are several team members working on the same project, who would risk overwriting each others’ code: 
https://github.com/rafael-minuesa/displaypostsrestapi

**05. Deploy**
The WordPress package has been deployed at this website by downloading it from the official repository, creating a Database, setting up wp-config.php, and running the Install. 

As a design tool I’ve chosen Elementor because of its clean code. Additionally I implemented a Content Delivery Network (CDN), several SEO enhancements, accessibility features (while trying to follow the original design guidelines), plus cache systems to help with speed and performance.

![Screenshot](https://github.com/rafael-minuesa/displaypostsrestapi/blob/master/proton.prowoos.com_screenshot.png)

