Here is a template for your page

```javascript
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
#Literals
```javascript
1
true
false
"this is a string"
3.14
```

#Expressions
```javascript
1+1
2*2
(3+2)>(5*3)
```

#Statements
Certain operations don't evaluate to any particular value. These are called statements. They are usually performed for their "side effects". The print function defined in our template is an example. `print("Hello World!");` does produce a value. It is useful because it has the "side effect" of displaying a string on the page.

A function call can be a statement or an expression, depending on whether the function returns anything. `print("Hello World!")`, for example, is a statement because the print function does not return anything. `Math.round(15.5, 0)`, on the other hand, is an expression becuase it the round function returns a value.

#Talk about simple statements

Talk about assignment

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
```

Here is a while template:
```
while([true/false expression]) {
	[statement one]
	[statement two]
	[...]
}
```
