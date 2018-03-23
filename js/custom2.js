function filterData() 
{
	var input, filter, table, tr, td, i;
	input = document.getElementById("filterAcnum");
	filter = input.value.toUpperCase();
	table = document.getElementById("dataTable");
	tr = table.getElementsByTagName("tr");
	for (i = 1; i < tr.length; i++) 
	{
		td = tr[i].getElementsByTagName("td")[0];
		if (td) 
		{
			if (td.innerHTML.toUpperCase().indexOf(filter) > -1)
			{
				tr[i].style.display = "";
			} else
			{
				tr[i].style.display = "none";
			}				
		}       
	}
}

function filterDname() 
{
	var input, filter, table, tr, td, i;
	input = document.getElementById("filterName");
	filter = input.value.toUpperCase();
	table = document.getElementById("dataTable");
	tr = table.getElementsByTagName("tr");
	for (i = 1; i < tr.length; i++) 
	{
		td = tr[i].getElementsByTagName("td")[1];
		if (td) 
		{
			if (td.innerHTML.toUpperCase().indexOf(filter) > -1)
			{
				tr[i].style.display = "";
			} else
			{
				tr[i].style.display = "none";
			}				
		}       
	}
}

function showPwd() 
{
	var x = document.getElementById("password");
	if (x.type === "password") 
	{
		x.type = "text";
	}
		else
	{
		x.type = "password";
	}
}


