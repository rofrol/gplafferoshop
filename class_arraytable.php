<?php
//http://www.phpclasses.org/browse/package/2047.html
class ArrayTable
{
	// description: Show a table filled with 2D-array-values.
	//              Order-by and many other options available.
	// files:       Use with class_forms.php.
	//              Use with class_windowlink.php.
	//              Make a rootfolder images with edit16.gif,del16.gif,order16.gif.
	// version:     0.1
	// history:     04-01-2005 First version.

	var $Name;
	var $Borderwidth = 1;
	var $Cellpadding = 1;
	var $Cellspacing = 1;
	var $Background_color = "white";
	var $Font = "Arial";
	var $Font_size = 2;
	var $Font_color = "black";
	var $Row_color_odd = "white";
	var $Row_color_even = "D6E3D3";
	var $Header_fields = array();
	var $Header_color = "336633";
	var $Cell_align = array();
	var $Header_font = "Arial";
	var $Header_font_size = 2;
	var $Header_font_color = "white";
	var $Header_font_bold = 1;
	var $Current_page;
	var $Session_varname;
	var $Session_id;
	var $Extra_URI = "";		// Keep empty, set with SuperTable(params)
	var $Hidecols = array();	// kolomnummers die niet getoond moeten worden
	var $Hide_zeros = 0;
	var $Order_columns = array();
	var $Order_icon_url = "/images/order16.gif";
	var $Order_by_col_nr;
	var $Data = array();

	function ArrayTable($current_page,$extrauri = "")
	{
		$this->Current_page = $current_page;
		$this->Extra_URI = $extrauri;
	}

	function SortMultiArray($tabel,$orderkolom,$direction)
	{
		$dummy = array();	// needed for sorting

		for ($aant = 0; $aant < (sizeof($tabel)); $aant++)
		{
			for ($rij = 0; $rij < (sizeof($tabel)-1); $rij++)
			{
				$huidige = $tabel[$rij][$orderkolom];
				$volgende = $tabel[$rij+1][$orderkolom];
				// Hyperlink ignorance.
				if (substr($huidige,1,3) == "a h") $huidige = $huidige[9];	// Replace with first nonlink char.
				if (substr($volgende,1,3) == "a h") $volgende = $volgende[9]; // Replace with first nonlink char.
				if ( (($direction == "a")&&($huidige > $volgende))
					|| (($direction == "d")&&($huidige < $volgende)) )
				{
					$dummy = $tabel[$rij];
					$tabel[$rij] = $tabel[$rij+1];
					$tabel[$rij+1] = $dummy;
				}
			}
		}
		return $tabel;
	}

	function Show()
	{
		// show rows
		$rownr = 0;
		$x = 0;
		$y = 0;

		// html table definitie
		print"<table";
		print" border=".$this->Borderwidth;
		print" cellpadding=".$this->Cellpadding;
		print" cellspacing=".$this->Cellspacing;
		print" bgcolor=".$this->Background_color;
		print">";

		// use order_by_col_nr
		if (!empty($this->Order_by_col_nr))
		{
			$this->Data = $this->SortMultiArray($this->Data,($this->Order_by_col_nr-1),"a");	// tabel sorteren
		}

		// toon rijen
		while ($y < sizeof($this->Data))
		{
			// make header
			if ($y == 0)
			{			
				print"<tr";
				print" bgcolor=".$this->Header_color;
				print">";
				while (!empty($this->Data[0][$x])) 
				{
					print"<td>";
					print"<font";
					print" face='".$this->Header_font."'";
					print" size=".$this->Header_font_size;
					print" color='".$this->Header_font_color."'";
					print">";
					if ($this->Header_font_bold) print"<b>";
					print $this->Header_fields[$x];
					if ($this->Header_font_bold) print"</b>";
					print "<a href='".$this->Current_page."?orderby=".($x+1).$this->Extra_URI."'><img src='".$this->Order_icon_url."' border=0></a>";
					print"</td>";
					$x++;
				}
				print"</tr>";
			}

			// not header rows
			print"<tr>";		// toon velden
			$x = 0;
			while (!empty($this->Data[$y][$x]))
			{
				// show field
				print"<td";
				print" bgcolor=";
				if ($y%2) print $this->Row_color_even;
					else print $this->Row_color_odd;
				if (!empty($this->Cell_align[$x-1]))
					print" align=".$this->Cell_align[$x-1];
				else print" align=right";
				print">";
				print"<font";
				print" face='".$this->Font."'";
				print" size=".$this->Font_size;
				print" color='".$this->Font_color."'";
				print">";
				print $this->Data[$y][$x];		// toon waarde
				print"</font>";
				print"</td>";			
				$x++;
			}
			print"</tr>";
			$y++;
		}
		print"</table>";
	}
}

?>
