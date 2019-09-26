**Hospital Management System**

Aim for hospital dbms is to provide  both patients and doctors easily accessible information such as

-Who are the patients assigned to doctor? (rel to doctor)

-When is doctor freely available?(rel to patient)

-How many patients come each day to hospital? (rel to manager/admin)

**Guidelines**

Designing a dbms is a complex and hard process which involve following steps

1. Requirement Analysis: Stating the problem statement clearly i.e.

  - why is going to be stored i.e. which entities you are going to store, what is relationship between them etc.
  - What are we going to do with the data i.e. provide info to which entities
  - Who is going to access the data

2. ER Modelling: Next step is modelling the dbms based on the requirements. There are various models available but one of the famous one is ER modelling which involves defining entities and relationship between them.

**Specifications**

1. We want to store details of patients
  - Name,
  - Date of birth,
  - Disease
  - Doctor Referred to
  - Current Status: admit, icu, normal etc.
  - Price to pay
2. Details of doctor
  - Specialisation
  - Dob
  - Place residence
  - Free Time
  - Patients currently under diagonosis
  - Salary
  - Free time

**Specifications**
  - Patient cann’t access doctor’s personal information other than specialisation.
  - Doctor has access to patient’s detail other than price to pay.
  - Admin can access to each and every detail of both patient and doctor.
  - Only admin can insert and update doctor as well as patient’s entry.
  - One patient can be referred to only one doctor at a time.
  - Doctor can diagnos more than one patients.
  - Doctor will diagnos patient only if disease comes under his/her specialization.
  - Every patient must be assigned to some doctor.
  - Sign up option is provided only by admin, doctor and patients are only able to login.
  - After log in doctor and patients have the option to update their records except disease date of birth doctor referred to and other options.
  - Patient should be assigned to only that doctor which exist in the database.
  - Doctor can see only those patient’s record which are assigned to him.
