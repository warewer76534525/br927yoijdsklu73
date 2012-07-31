function confirmDelete()
{
    return confirm("Are you sure you want to delete this entry?");
} 

function formatDollar(num, fixed) 
{
  if(fixed == 0){ return num; }
	var p = num.toFixed(fixed).split(".");
	return p[0].split("").reverse().reduce(function(acc, num, i, orig) {
		return  num + (i && !(i % 3) ? "," : "") + acc;
	}, "") + "." + p[1];
}