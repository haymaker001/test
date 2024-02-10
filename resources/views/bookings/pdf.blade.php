<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-15">
    <style>
    body { font-family: verdana, sans-serif;} 
    table {
      margin-top: 1em;
      margin-bottom: 2em;
    }

    thead {
    }

    tbody {
    }

    th,td {
      padding: 3pt;
    }

    table.collapse {
      border-collapse: collapse;
      width: 100% !important;
    }

    table.collapse td {
    }

    td.header {
    	font-size: 12px;
    }

    td.data {
    	font-size: 12px;
    }
    .align-center {
    	text-align: center;
    }
    #footer {
      	position: fixed;
      	left: 0;
    	right: 0;
    	bottom: 0;
    	color: #aaa;
    	font-size: 0.9em;
    }
    #footer table {
    	width: 100%;
    	border-collapse: collapse;
    	border: none;
    }
    #footer td {
      	padding: 0;
    	width: 50%;
    }

    .opacity {
        opacity: 0.1;
    }
    #watermark {
        position: fixed;
        bottom:   0px;
        left:    150px;
        top:     450px;
        /** The width and height may change 
            according to the dimensions of your letterhead
        **/
        width:    21.8cm;
        height:   28cm;

        /** Your watermark should be behind every content**/
        z-index:  -1000;
    }

    </style>

</head>

<body>


<div id="watermark">
    <div style="opacity: 0.2;">
        <img style="width: 50%;" src="https://henriquez.com.do/wp-content/uploads/2018/05/watermark.jpg" />
    </div>
</div>

--------------------------------------------------------------------------------------------- CONDUCE DE TRANSPORTE


<table class="collapse">
  	<tr>
    	<td colspan="3">
    	    <img style="width: 40%;" src="https://henriquez.com.do/wp-content/uploads/2018/05/logo.jpg"/>
    	    <p style="margin:0px; padding:0px;">Av Simón Bolívar #195 <br> Santo Domingo, República Dominicana.</p>
    	</td>
  	    <td style="width: 20%; text-align:center"><strong>No. CONDUCE: </strong> {{ $booking->id }}</td>
  	</tr>
  	<tr>
		<td colspan="4">&nbsp;</td>
  	</tr>
  	<tr>
		<td colspan="4">&nbsp;</td>
  	</tr>
  	<tr>
		<td colspan="4">&nbsp;</td>
  	</tr>
</table>

<table class="collapse">
  	<tr>
		<td valign="top" class="header" style="border-top: 1px solid black; border-left:  1px solid black; border-bottom: 1px solid black;"><strong>CLIENTE</strong></td>
		<td valign="top" class="header align-center" style="border-top: 1px solid black; border-bottom: 1px solid black;"><strong>FECHA <br> REALIZACIÓN <br> SERVICIO</strong></td>
		<td valign="top" class="header"  style="border-top: 1px solid black; border-bottom: 1px solid black;"><strong>DESTINO</strong></td>
		<td valign="top" class="header align-center" style="border-top: 1px solid black; border-bottom: 1px solid black;"><strong>EQUIPO</strong></td>
		<td valign="top" class="header" style="border-top: 1px solid black; border-bottom: 1px solid black;"><strong>CHOFER</strong></td>
		<td valign="top" class="header align-center" style="border-top: 1px solid black; border-bottom: 1px solid black;"><strong># TRANSPORTE <br> CLIENTE</strong></td>
		<td valign="top" class="header" style="border-top: 1px solid black; border-right:  1px solid black; border-bottom: 1px solid black;"><strong>TIPO DE <br> VIAJE</strong></td>
  	</tr>
  	<tr>
		<td valign="top" class="data">{{ $booking->customer->name }}</td>
		<td valign="top" class="data align-center">{{ $booking->pickup }}</td>
		<td valign="top" class="data">{{ $booking->locations }}</td>
		<td valign="top" class="data">{{ $booking->vehicle->name }}</td>
		<td valign="top" class="data">{{ $booking->driver->name }}</td>
		<td valign="top" class="data">{{ $booking->travellers }}</td>
		<td valign="top" class="data">{{ $booking->travel_type->name }}</td>
  	</tr>
</table>

<div id="footer">
    <p class="align-center">
        DEPARTAMENTO DE TRANSPORTE <br>
        _______________________________________________________________________
    </p>
	<div class="page-number align-center"><img style="width: 25%;" src="https://henriquez.com.do/wp-content/uploads/2018/05/sello.jpg"/></div>
</div>


</body> </html>