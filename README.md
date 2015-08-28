# Blogroll

A simple, one-page blogroll written with [jQuery](http://jquery.com) and [Bootstrap](http://getbootstrap.com).

---

## Installation

#### Quick Install (from zip)

1. Download the latest release zip from [https://github.com/acburdine/blogroll/releases](here)
2. Unzip the file into your web directory
3. Enjoy!

#### Developer Install (from git)

1. Make sure you have [Bower](http://bower.io) installed on your computer.
2. Clone the repo: `git clone https://github.com/acburdine/blogroll /path/to/clone/dir`
3. Change directory into your install directory: `cd /path/to/clone/dir`
4. Install bower components: `bower install`
5. Use

---

## Documentation

the blogroll page comes with a few files:

- `assets` contains all CSS and JS needed to make the page work
- `index.html` is the actual page
- `bloglist.json` is the data needed for the blog list

To add blogs to the list, open `bloglist.json` in a text editor.

#### bloglist.json structure

- "name": The name for your blogroll. Used in the title of the page as well as a header
- "description": A short description of your blogroll. Also goes in the header
- "blogs": An object containing the list of blogs. Each key in the object is the blog link, and the value is a short description of what the blog is.

###### Example bloglist.json

```json
{
    "name": "Blogroll",
    "description": "A short example description",
    "blogs": {
        "http://example.com": "Some Blog",
        "http://blog.github.com": "Github's Blog",
        "http://googleblog.blogspot.com": "Google's Blog"
    }
}
```
