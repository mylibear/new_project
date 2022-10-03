import React, { useState, useEffect } from "react";
import styled from "styled-components";
import Logout from "./Logout";


export default function Contacts({ contacts, changeChat }) {
  const [currentUserName, setCurrentUserName] = useState(undefined);
  const [currentUserImage, setCurrentUserImage] = useState(undefined);

  const [currentSelected, setCurrentSelected] = useState(undefined);
  useEffect(async () => {
    const data = await JSON.parse(
      localStorage.getItem(process.env.REACT_APP_LOCALHOST_KEY)
    );
    setCurrentUserName(data.username);
    setCurrentUserImage(data.avatarImage);

  }, []);


  const changeCurrentChat = (index, contact) => {
    setCurrentSelected(index);
   
  };
  return (
    <>
      {currentUserImage && currentUserImage && (
        <Container>
          <div className="brand">
      
          <div className="current-user">
            <div className="avatar">
              <img
                src={`data:image/svg+xml;base64,${currentUserImage}`}
                alt="avatar"
              />
            </div>
            <div className="username">
              <h2>{currentUserName}</h2>
            </div>
          </div>
          <Logout />
          </div>
         
        </Container>
      )}
    </>
  );
}
const Container = styled.div`
 

  overflow: hidden;
  background-color: #97D9E1;
  .brand {
    display: flex;
    align-items: center;
    gap: 1rem;
    justify-content: center;
    img {
      height: 1rem;
    }
    
  }


  .current-user { 
    align-items: center;
    gap: 3rem;
    .avatar {
      img {
        height: 4rem;
        max-inline-size: 100%;
      }

 
    }
    .username {
      h2 {
        color: white;
      }
    }
    @media screen and (min-width: 720px) and (max-width: 1080px) {
      gap: 0.5rem;
      .username {
        h2 {
          font-size: 1rem;
        }
      }
    }
  }
`;
