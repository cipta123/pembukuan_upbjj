<!DOCTYPE html>
<html>
<head>
	<title>Laporan Pembukuan</title>
</head>
<style type="text/css">
	.grid-1{
		display: grid;
		width: 100%;
		grid-template-columns: repeat (1,1fr);
		grid-template-areas: "header header header"
							 "main main main" ;
	}
.grid-1 div {
  color: white;
  font-size: 20px;
  padding: 20px;
  }

/* specific item styles */

.item-1 {
  background: #b03532;
  grid-area: header;
}

.item-2 {
  background: yellow;
  grid-area: main;
}




</style>

<body>
<section class="grid-1">
	 <div class="item-1">
	 	

	 	
	 </div>
	 <div class="item-2">
	 	




	 	
	 </div>


</section>
</body>
</html>