Here is a template for your page

```
<html>
<body>
<div id="output">
</div>
<script>
function print(str) {
	var outputdiv = document.getElementById("output");
	outputdiv.innerHTML = outputdiv.innerHTML + str + "<br/>";
}
</script>
<script>
//YOUR CODE STARTS HERE

print("Hello World!");

//YOUR CODE ENDS HERE
</script>
</body>
</html>
```

This is a template for an if statement. Things between square brackets are placeholders designed to be replaced by your code.

```
if([true/false expression]) {
	[statement one]
	[statement two]
	[...]
} else if([true/false expression]) {
	[statement one]
	[statement two]
	[...]
} else {
	[statement one]
	[statement two]
	[...]
	
}

