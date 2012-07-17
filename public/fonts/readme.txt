

You can start using the Google Web Fonts API in just two steps:

Add a stylesheet link to request the desired web font(s):
<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Font+Name">


Style an element with the requested web font, either in a stylesheet:
CSS selector {
  font-family: 'Font Name', serif;
}

or with an inline style on the element itself:
<div style="font-family: 'Font Name', serif;">Your text</div>




Note: When specifying a web font in a CSS style, always list at least one fallback web-safe font in order to avoid unexpected behaviors. 
      In particular, add a CSS generic font name like serif or sans-serif to the end of the list, so the browser can fall back to its default fonts if need be.