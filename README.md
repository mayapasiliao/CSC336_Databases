# CSC336_Databases

Assignment description:

1)	A CD has a title, a year of production and a CD type. You can come with you own CD types.  
2)	A CD usually has multiple songs on different tracks. Each song has a name, an artist and a track number. Entity set Song is considered to be weak and needs support from entity set CD. 
3)	A CD is produced by a producer which has a name and an address. 
4)	A CD may be supplied by multiple suppliers, each has a name and an address.  
5)	A customer may rent multiple CDs. Customer information such as Social Security Number (SSN), name, telephone needs to be recorded.  The date and period of renting (in days) should also be recorded. 
6)	A customer may be a regular member and a VIP member. A VIP member has additional information such as the starting date of VIP status and percentage of discount. 

Write a menu-drive program (e.g. using PHP) to enable the following queries. You will need to supply with your own test data.
1)	Insert a producer
2)	Insert a CD supplied by a particular supplier and produced by a particular producer
3)	Insert a regular-customer borrowing a particular CD
4)	Insert a VIP customer borrowing a particular CD
5)	Find names and Tel# of all customers who borrowed a particular CD and are supposed to return by a particular date
6)	List producer's information who produce CD of a particular artist released in a particular year
