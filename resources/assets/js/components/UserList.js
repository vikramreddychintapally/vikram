import React, { Component, useEffect, useState } from "react";
import axios from "axios";
import { Table, Form, Button } from "react-bootstrap";
import ReactDOM from "react-dom";

const UserList = () => {
  const [usersList, setUsersList] = useState([]);
  const [roles, setRoles] = useState([]);
  const [addUserModel, setaddUserModel] = useState(false);
  const [userName, setuserName] = useState("");
  const [email, setEmail] = useState("");
  const [selroles, setSelRoles] = useState([]);

  const addUsers = () => {
    setaddUserModel(!addUserModel);
  };

  const getUserList = () => {
    //Get UserList
    axios
      .get(`http://127.0.0.1:8000/getUserList`)
      .then(res => {
        setUsersList(res.data.data);
      })
      .catch(error => console.log(error, "errr"));
  };

  useEffect(() => {
    getUserList();
  }, []);

  useEffect(() => {
    //Get getRoles
    axios
      .get(`http://127.0.0.1:8000/getRoles`)
      .then(res => {
        setRoles(res.data.data);
      })
      .catch(error => console.log(error, "errr"));
  }, []);

  //Deleting User
  const deleteUser = userId => {
    axios
      .delete(`http://127.0.0.1:8000/deleteUser/` + userId)
      .then(res => {
        const del = usersList.filter(user => userId !== user.id);
        setUsersList(del);
      })
      .catch(error => console.log(error, "errr"));
  };

  //Adding Users
  const submitForm = () => {
    const userDetails = {
      name: userName,
      email: email,
      role: selroles
    };
    axios
      .post(`http://127.0.0.1:8000/storeUser`, userDetails)
      .then(res => {
        console.log(res);
        getUserList();
        setaddUserModel(!addUserModel);
      })
      .catch(error => alert(error));
  };

  const rolesList = roles.map(role => {
    return (
      <div>
        <Form.Check
          type="checkbox"
          name="roles[]"
          onChange={e => setSelRoles([...selroles, e.target.value])}
          value={role.id}
          label={role.role_name}
        />
      </div>
    );
  });
  return (
    <div>
      <Button onClick={addUsers}>Add User</Button>
      {addUserModel && (
        <Form>
          <Form.Label>User Name</Form.Label>
          <Form.Control
            type="text"
            placeholder="Enter Name"
            id="userName"
            name="userName"
            onChange={e => setuserName(e.target.value)}
          />
          <Form.Label>Email</Form.Label>
          <Form.Control
            type="email"
            placeholder="Enter email"
            name="email"
            onChange={e => setEmail(e.target.value)}
          />
          Roles {rolesList}
          <Button onClick={submitForm}>Submit</Button>
        </Form>
      )}
      <Table striped bordered hover responsive="md">
        <thead>
          <tr>
            <td>User Name</td>
            <td>Email</td>
            <td>Roles</td>
            <td>Action</td>
          </tr>
        </thead>
        <tbody>
          {usersList.map(user => {
            return (
              <tr key={user.id}>
                <td>{user.name}</td>
                <td>{user.email}</td>
                <td>{user.roles.toString()}</td>
                <td>
                  <span onClick={() => deleteUser(user.id)}>Delete</span>
                </td>
              </tr>
            );
          })}
        </tbody>
      </Table>
    </div>
  );
};

export default UserList;
