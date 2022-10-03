import React, { useState, useEffect } from "react";
import axios from "axios";
import styled from "styled-components";
import { useNavigate, Link } from "react-router-dom";
import Logo from "../assets/cute-koala.gif";
import { ToastContainer, toast } from "react-toastify";
import "react-toastify/dist/ReactToastify.css";
import { registerRoute } from "../utils/APIRoutes";
import Registerinfo from "../components/Registerinfo";
import Banner from "../components/Banner";

export default function Register() {
  const navigate = useNavigate();
  const toastOptions = {
    position: "bottom-right",
    autoClose: 8000,
    pauseOnHover: true,
    draggable: true,
    theme: "dark",
  };
  const [values, setValues] = useState({
    username: "",
    email: "",
    password: "",
    confirmPassword: "",
  });

  useEffect(() => {
    if (localStorage.getItem(process.env.REACT_APP_LOCALHOST_KEY)) {
      navigate("/");
    }
  }, []);

  const handleChange = (event) => {
    setValues({ ...values, [event.target.name]: event.target.value });
  };

  const handleValidation = () => {
    const { password, confirmPassword, username, email } = values;
    if (password !== confirmPassword) {
      toast.error(
        "Password and confirm password should be same.",
        toastOptions
      );
      return false;
    } else if (username.length < 3) {
      toast.error(
        "Username should be greater than 3 characters.",
        toastOptions
      );
      return false;
    } else if (password.length < 8) {
      toast.error(
        "Password should be equal or greater than 8 characters.",
        toastOptions
      );
      return false;
    } else if (email === "") {
      toast.error("Email is required.", toastOptions);
      return false;
    }

    return true;
  };

  const handleSubmit = async (event) => {
    event.preventDefault();
    if (handleValidation()) {
      const { email, username, password } = values;
      const { data } = await axios.post(registerRoute, {
        username,
        email,
        password,
      });

      if (data.status === false) {
        toast.error(data.msg, toastOptions);
      }
      if (data.status === true) {
        localStorage.setItem(
          process.env.REACT_APP_LOCALHOST_KEY,
          JSON.stringify(data.user)
        );
        navigate("/");
      }
    }
  };

  return (
    <>
        <div className="banner"><Banner/></div>
        <div className="instruction">
         <div className="registerinfo"><Registerinfo/></div>
      <FormContainer>
        <form action="" onSubmit={(event) => handleSubmit(event)}>
          <div className="brand">
            <img src={Logo} alt="logo" />
            <h1>SIMPLIFY</h1>
          </div>
          <input
            type="text"
            placeholder="Username"
            name="username"
            onChange={(e) => handleChange(e)}
          />
          <input
            type="email"
            placeholder="Email"
            name="email"
            onChange={(e) => handleChange(e)}
          />
          <input
            type="password"
            placeholder="Password"
            name="password"
            onChange={(e) => handleChange(e)}
          />
          <input
            type="password"
            placeholder="Confirm Password"
            name="confirmPassword"
            onChange={(e) => handleChange(e)}
          />
          <button type="submit">Confirm</button>
          <span>
            Already have an account ? <Link to="/login">Login.</Link>
          </span>
        </form>
      </FormContainer>
      <ToastContainer />
      </div>
    </>
  );
}

const FormContainer = styled.div`
    

    height: 90vh;
    width: 70vw;
    display: flex;
    flex-direction: column;
    justify-content: center;
    gap: 1rem;
    align-items: center;
  
  
    
    


    .brand {
        display: flex;
        align-items: center;
        gap: 1rem;
        justify-content: center;
        img {
            height: 8rem;
        }
        h1 {
            color: white;
            text-transform: uppercase;
        }
    }
        
        form {
            display: flex;
            flex-direction: column;
            gap: 2rem;
            
            border-radius: 2rem;
            padding: 2rem 4rem;
          }
          input {
            background-color: #FFE4C4;
            padding: 1rem;
            
            
            border-radius: 3rem;
            color:#808080;
            width: 100%;
            font-size: 1rem;
            &:focus {
              border: 0.1rem solid #997af0;
              outline: none;
            }
          }
          button {
            background-color: #41E316;
            margin-left:33%;
            width:125px;

            color: white;
            padding: 1rem 1rem;
            font-weight: bold;
            cursor: pointer;
            border-radius: 0.4rem;
            text-transform: uppercase;
            border-radius: 20px;
            border: 5px solid #256536;
            &:hover {
              border-style: solid;
              border-color: green;
              background-color: #24fc91;
              text-transform: uppercase;
              transition: transform 80ms ease-in;
            }
          }
          span {
            color: white;
            text-transform: uppercase;
            a {
              color: #41E316;
              text-decoration: none;
              font-weight: bold;
            }
          }
    }
`;