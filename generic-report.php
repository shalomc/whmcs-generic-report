<?php

if (!defined("WHMCS"))
    die("This file cannot be accessed directly");

// Report display parameters. Modify as needed.
$reportdata['title'] = "Invoices for " . $currentmonth . " " . $currentyear;
$reportdata['description'] = "This report shows a detailed list of invoices created for a given month";
$reportdata['monthspagination'] = true;

// SQL query. Use backticks `` to create descriptive column names.
$query =          " SELECT invoices.id, invoices.userid as `Customer ID`, invoices.invoicenum as `Invoice Number`, invoices.date, invoices.duedate, invoices.subtotal, ";
$query = $query . " invoices.datepaid, invoices.credit, invoices.tax, invoices.tax2, invoices.total, invoices.taxrate, invoices.taxrate2, invoices.status, ";
$query = $query . " invoices.paymentmethod, invoices.notes, clients.companyname, currencies.code as currency, groups.groupname ";
$query = $query . " FROM tblinvoices invoices join tblclients clients on invoices.userid=clients.id ";
$query = $query . " join tblclientgroups groups on clients.groupid=groups.id ";
$query = $query . " join tblcurrencies currencies on clients.currency=currencies.id ";
$query = $query . " WHERE invoices.date LIKE '" . $year . "-" . $month . "-%' ";

$result = full_query($query);

while($data = mysql_fetch_assoc($result)) {
	$reportdata["tableheadings"] = array_keys($data);
    $reportdata["tablevalues"][] = $data;

}

