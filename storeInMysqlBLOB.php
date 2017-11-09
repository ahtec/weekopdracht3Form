<?php

/* *First: Create a table, for example:
CREATE TABLE picture (
ID	INTEGER AUTO_INCREMENT,
IMAGE	BLOB, 
PRIMARY KEY (ID)
) ENGINE=InnoDB;

2) To read a image to a QByteArray
*/
/*
QString fileName = "IMAGE.JPG";

QImage image(filaName);
LBL_IMAGE->setPixmap(QPixmap::fromImage(image)); // Put image into QLabel object (optional)

// load image to bytearray
QByteArray ba;
QFile f(fileName);
if(f.open(QIODevice::ReadOnly))
{
ba = f.readAll();
f.close();
}

// Writing the image into table
QSqlDatabase::database().transaction();

QSqlQuery query;
query.prepare( "INSERT INTO picture ( IMAGE ) VALUES (:IMAGE)" );
query.bindValue(":IMAGE", ba);
query.exec();
if( query.lastError().isValid()) {
qDebug() << query.lastError().text();
QSqlDatabase::database().rollback();
} else
QSqlDatabase::database().commit();

//3) Now, recovery the field with the image

int idx = 1; // The records ID to recover

QSqlDatabase::database().transaction();
QSqlQuery query;
query.prepare("SELECT ID, IMAGE FROM picture WHERE ID=:ID");
query.bindValue(":ID", idx);
query.exec();
query.next();
if( query.lastError().isValid()) {
qDebug() << query.lastError().text();
QSqlDatabase::database().rollback();
} else { 
QByteArray ba1 = query.value(1).toByteArray();
QPixmap pic;
pic.loadFromData( ba1);

// Show the image into a QLabel object
LBL_IMAGE->setPixmap(pic);
QSqlDatabase::database().commit();
}

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

