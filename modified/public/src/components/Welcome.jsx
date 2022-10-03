import React, { useState, useEffect } from "react";
import styled from "styled-components";
import Cat from "../assets/cute-cat.gif";
import Logout from "./Logout";
export default function Welcome() {
  const [userName, setUserName] = useState("");
  const [currentPetImage, setCurrentPetImage] = useState(undefined);
  useEffect(async () => {
    const data = await JSON.parse(
      localStorage.getItem(process.env.REACT_APP_LOCALHOST_KEY)
    );
    setUserName(
      await JSON.parse(
        localStorage.getItem(process.env.REACT_APP_LOCALHOST_KEY)
      ).username

      
    );

    setCurrentPetImage(data.petImage);




  }, []);
  return (
    <Container>
        
      <img src={Cat} alt="" />
      
      <h1>
        Welcome, <span>{userName}!</span>
      </h1>


    </Container>
  );
}

const Container = styled.div`
  display: flex;
  justify-content: center;
  align-items: center;
  color: white;
  background-color: #97D9E1  ;
  flex-direction: column;
  img {
    height: 20rem;
  }
  span {
    color: white;
  }
`;
