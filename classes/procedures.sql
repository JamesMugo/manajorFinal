DELIMITER $$
create procedure insertOwners(
in staffID int(11),
in firstname varchar(255),
in lastname varchar(255),
in idNumber int(50),
in propertyOwned varchar(255),
in location varchar(255),
in number_of_rooms int(11),
in agreementForm varchar(255))

BEGIN
	insert into owners(staffID, firstname, lastname, idNumber, propertyOwned, location, number_of_rooms, agreementForm) 
    values(staffID, firstname, lastname, idNumber, propertyOwned, location, number_of_rooms, agreementForm);
insert into property(staffID, ownerid, description, capacity, location) 
    values(staffID, LAST_INSERT_ID(), propertyOwned, number_of_rooms, location);    
END$$
DELIMITER ;



DELIMITER $$
create procedure insertTenant(
in staffID int(11),
in firstname varchar(255),
in lastname varchar(255),
in nationalid int(50),
in contacts varchar(255),
in propertyno int(11),
in roomID int(11))

BEGIN
	INSERT INTO tenants(staffID, firstname, lastname, nationalid, contacts, propertyno, houseno) 
    values(staffID, firstname, lastname, nationalid, contacts, propertyno, houseno);

    UPDATE rooms SET rentalstatus='occupied' where roomID=roomID;    
END$$
DELIMITER ;


DELIMITER $$
create procedure insertTenant(
in payment_status varchar(255),
in price decimal(9,2))


BEGIN
	SELECT SUM(price) as revenue from rooms where rentalstatus='occupied'
	INSERT INTO tenants(staffID, firstname, lastname, nationalid, contacts, propertyno, houseno) 
    values(staffID, firstname, lastname, nationalid, contacts, propertyno, houseno);

    UPDATE rooms SET rentalstatus='occupied' where roomID=roomID;    
END$$
DELIMITER ;