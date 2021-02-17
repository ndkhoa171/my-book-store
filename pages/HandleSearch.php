<?php 
    if(isset($_GET['search_button']))
    {
      if($_GET['_nameBook']!='')
      {
        $nameBook=$_GET['_nameBook'];
        $sql_Product=$sql_Product." and products.ProductName like N'%$nameBook%' "; 
      }
      if($_GET['_categoryBook']!='')
      {
        $categoryBook=$_GET['_categoryBook'];
        $sql_Product=$sql_Product." and categories.CategoryName like N'%$categoryBook%' "; 
      }
      if($_GET['_companyBook']!='')
      {
        $companyBook=$_GET['_companyBook'];
        $sql_Product=$sql_Product." and publishingcompanys.PublishingCompanyName like N'%$companyBook%' "; 
      }
      if($_GET['_authorBook']!='')
      {
        $authorBook=$_GET['_authorBook'];
        $sql_Product=$sql_Product." and products.Author like N'%$authorBook%' "; 
      }
      if($_GET['From_Price']>0)
      {
        $From_Price=$_GET['From_Price'];
        $sql_Product=$sql_Product." and products.UnitPrice >= $From_Price "; 
      }
      if($_GET['To_Price']>0)
      {
        $To_Price=$_GET['To_Price'];
        $sql_Product=$sql_Product." and products.UnitPrice <= $To_Price "; 
      }
    }
?>