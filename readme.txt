CloakMaster for Elementor

Contributors: Oleksandr Homenko
Requires at least: 5.0
Tested up to: 6.x
Stable tag: 1.0.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

CloakMaster for Elementor is a plugin designed to dynamically control the visibility of Elementor elements based on visitor type detection. This plugin lets you decide which elements should be hidden from bots or from human users before they are rendered on the page.

Description

CloakMaster for Elementor integrates with Elementor’s hooks to provide fine-grained visibility control over each widget or container. It works by adding custom controls in the “Advanced” tab of your Elementor elements, allowing you to easily specify conditions such as:
	•	Hide element from bots
	•	Hide element from users

This ensures that undesired content is not just visually hidden via CSS, but is never rendered for the specified audience. Use this plugin to optimize user experience and enhance security or SEO strategies, by selectively showing or hiding content on your pages.

Features
	•	Elementor Integration: Seamlessly integrates with Elementor’s interface, appearing in the “Advanced” tab of each widget or container.
	•	Bot/User Detection: Set conditions to show or hide elements depending on whether the visitor is a bot or a user.
	•	No CSS Needed: Conditions are implemented before the element is rendered, ensuring no unnecessary output in the HTML.

Installation
	1.	Download the CloakMaster for Elementor plugin ZIP file.
	2.	In your WordPress admin panel, go to Plugins > Add New.
	3.	Click Upload Plugin and select the downloaded ZIP file.
	4.	Activate the plugin once it is installed.

Usage
	1.	Open any page or template with the Elementor editor.
	2.	Select the widget or container you want to manage.
	3.	Go to the Advanced tab.
	4.	Scroll down to find the “Visibility by Bot/User” section.
	5.	Toggle the switches “Hide From Bots” or “Hide From Users” as needed.
	6.	Update the page.

The chosen elements will now conditionally render based on the visitor type.

Frequently Asked Questions

Q: How does the plugin detect bots vs. users?
A: The plugin relies on a predefined detection logic that you can customize. By default, it assumes a function is_bot_or_user() that you either define or include from your code. Integrate your own detection method to accurately classify visitors.

Q: Will this slow down my website?
A: The plugin executes a simple check during Elementor’s render process. It should have a minimal performance impact.

Q: Can I apply conditions to all elements at once?
A: Yes. By not specifying conditions based on $element->get_name(), you can globally apply the hide logic to all elements passing through the specified hooks.

Changelog

1.0.0
	•	Initial release with bot/user visibility controls for Elementor elements.

License

This plugin is free and open-source, licensed under the GNU General Public License v2.0 or later. See License URI for details.