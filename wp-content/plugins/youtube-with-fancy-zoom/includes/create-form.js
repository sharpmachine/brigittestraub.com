/**
 *     Youtube with fancy zoom
 *     Copyright (C) 2011  www.gopiplus.com
 * 
 *     This program is free software: you can redistribute it and/or modify
 *     it under the terms of the GNU General Public License as published by
 *     the Free Software Foundation, either version 3 of the License, or
 *     (at your option) any later version.
 * 
 *     This program is distributed in the hope that it will be useful,
 *     but WITHOUT ANY WARRANTY; without even the implied warranty of
 *     MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *     GNU General Public License for more details.
 * 
 *     You should have received a copy of the GNU General Public License
 *     along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

function _ywfz_form()
{
	if((document.ywfz_form.ywfz_title.value).trim()=="")
	{
		alert("Please enter the title")
		document.ywfz_form.ywfz_title.focus();
		return false;
	}
	else if((document.ywfz_form.ywfz_watch.value).trim()=="")
	{
		alert("Please enter the video link.")
		document.ywfz_form.ywfz_watch.focus();
		return false;
	}
	else if((document.ywfz_form.ywfz_code.value).trim()=="")
	{
		alert("Please enter the video code.");
		document.ywfz_form.ywfz_code.focus();
		return false;
	}
	/*else if((document.ywfz_form.ywfz_imglink.value).trim()=="")
	{
		alert("Please enter the image link.");
		document.ywfz_form.ywfz_imglink.focus();
		return false;
	}*/
	else if(document.ywfz_form.ywfz_img.value=="")
	{
		alert("Please select the display image.")
		document.ywfz_form.ywfz_img.focus();
		return false;
	}	
	else if(document.ywfz_form.ywfz_status.value=="")
	{
		alert("Please select the display status.")
		document.ywfz_form.ywfz_status.focus();
		return false;
	}
	else if(document.ywfz_form.ywfz_sidebar.value=="")
	{
		alert("Please select the sidebar display.")
		document.ywfz_form.ywfz_sidebar.focus();
		return false;
	}
}
String.prototype.trim = function() 
{
	return this.replace(/^\s+|\s+$/g,"");
}


function _ywfz_redirect()
{
	window.location = "options-general.php?page=youtube-with-fancy-zoom/youtube-with-fancy-zoom.php";
}

function _ywfz_help()
{
	window.open("http://www.gopiplus.com/work/2010/07/18/youtube-with-fancy-zoom/");
}