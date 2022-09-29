import { NavigateNextOutlined } from '@mui/icons-material';
import {nanoid} from 'nanoid';
import React from 'react';
import { useState, Fragment } from 'react';
import { MemberTable } from '../../components/teamMemberTable/MemberTable';
import { MemberTableEditable } from '../../components/teamMemberTable/MemberTableEditable';
import './teamManagement.css';
import data from "./teamMemberData.json";


export default function TeamManagement() {
    const hideAndShow = () => {
        var x = document.getElementsByClassName("detail")[0];
    if (x.style.display === "none") {
      x.style.display = "block";
    } else {
      x.style.display = "none";
    }
    }

    const addMember = () => {
         var addMemberPage = document.getElementsByClassName("popup")[0];
      if (addMemberPage.style.display === "none") {
        addMemberPage.style.display = "block";
      } else {
        addMemberPage.style.display = "none";
      }
    }

    const [contacts, setContacts] = useState(data);

    const [addFormData, setAddFormData] = useState({
      memberName: '',
      email: '',
      dateAdded: '',
      taskAssigned: '',
      isLeader: ''
    })

    const [editContactId, setEditContactId] = useState(null);

    const handleEditClick = (event, contact) => {
      event.preventDefault();
      setEditContactId(contact.id);

      const formValues = {
        memberName: contact.memberName,
        email: contact.email,
        dateAdded: contact.dateAdded,
        taskAssigned: contact.taskAssigned,
        isLeader: contact.isLeader
      }

      setEditFormData(formValues);
    }

    const [editFormData, setEditFormData] = useState({
      memberName: '',
      email: '',
      dateAdded: '',
      taskAssigned: '',
      isLeader: ''
    })

    const handleAddFormChange = (event) => {
      event.preventDefault();

      const fieldName = event.target.getAttribute('name');
      const fieldValue = event.target.value;

      const newFormData = {...addFormData};
      newFormData[fieldName] = fieldValue;

      setAddFormData(newFormData);

    }

    const handleEditFormChange = (event) => {
      event.preventDefault();

      const fieldName = event.target.getAttribute("name");
      const fieldValue = event.target.value;

      const newFormData = {...editFormData};
      newFormData[fieldName] = fieldValue;

      setEditFormData(newFormData);
    }

    const handleAddFormSubmit = (event) => {
      event.preventDefault();

          var date = new Date();
          var y = date.getFullYear();
          var m = date.getMonth()+1;
          var d = date.getDate();

      const newContact = {
        id: nanoid(),
        memberName: addFormData.memberName,
        email: addFormData.email,
        dateAdded: d +"/" + m + "/" + y,
        taskAssigned: "None",
        isLeader: "No"
      }

      const newContacts = [...contacts, newContact];
      setContacts(newContacts);
    }

    const handleEditFormSubmit = (event) => {
      event.preventDefault();

      const editedContact = {
        id: editContactId,
        memberName: editFormData.memberName,
        email: editFormData.email,
        dateAdded: editFormData.dateAdded,
        taskAssigned: editFormData.taskAssigned,
        isLeader: editFormData.isLeader
      }

      const newContacts = [...contacts];

      const index = contacts.findIndex((contact) => contact.id === editContactId);

      newContacts[index] = editedContact;

      setContacts(newContacts);
      setEditContactId(null);
    }

    const handleDeleteClick = (contactId) => {
      const newContacts = [...contacts];

      const index = contacts.findIndex((contact)=> contact.id === contactId);

      newContacts.splice(index, 1);

      setContacts(newContacts);
    }


  return (
    <div className='featured'>
        <div className='featuredItem'>

            <h1>Team Management</h1>
            
            <div class="teamList">
                <div class='detail'>
                  <form onSubmit={handleEditFormSubmit} class='memberTable'>
                  <table>
                    <thead>
                      <tr>
                        <th>Team Member</th>
                        <th>Email</th>
                        <th>Date Added</th>
                        <th>Task Assigned</th>
                        <th>Leader</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      {contacts.map((contact) => (
                        <Fragment>
                          {editContactId === contact.id ? (
                            <MemberTableEditable editFormData={editFormData} handleEditFormChange={handleEditFormChange}/>
                          ) : (
                            <MemberTable contact={contact} handleEditClick={handleEditClick} handleDeleteClick={handleDeleteClick}/>)}

                        </Fragment>
                      ))}
                    </tbody>
                    
                  </table>
                  </form>
                  <button onClick={addMember} class="addMember"> + add member</button>
                </div>
                
            </div>

            <form class='popup' onSubmit={handleAddFormSubmit}>
              <button id="closeButton" onClick={addMember}>x</button>
              <input class='memberInput' type='text' name="memberName" required="required" placeholder='Member Name' onChange={handleAddFormChange}/>
              <br></br><br></br>
              <input class='memberInput' type='email' name="email" required="required"  placeholder='Email' onChange={handleAddFormChange}/>
              <br></br><br></br>
              <button type="submit">Add</button>
            </form>
            
        </div>

    </div>
  )
}
