import React from "react";
import { BrowserRouter, Routes, Route } from "react-router-dom";
import SetAvatar from "./components/SetAvatar";
import SetPet from "./components/SetPet";
import SelectedPet from "./components/SelectedPet";


import Chat from "./pages/Chat";
import Login from "./pages/Login";
import Register from "./pages/Register";

export default function App() {
  return (
    <BrowserRouter>
      <Routes>
        <Route path="/register" element={<Register />} />
        <Route path="/login" element={<Login />} />
        <Route path="/setAvatar" element={<SetAvatar />} />
        <Route path="/" element={<Chat />} />
        <Route path="/setPet" element={<SetPet />} />
        <Route path="/selectedPet" element={<SelectedPet />} />
   
      </Routes>
    </BrowserRouter>
  );
}
