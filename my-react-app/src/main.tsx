import { StrictMode } from 'react'
import { createRoot } from 'react-dom/client'
import './index.css'
import { BrowserRouter, Route, Routes } from 'react-router-dom'
import { Page2 } from './Page2.tsx'
import { App } from './App.tsx'

createRoot(document.getElementById('root')!).render(
  <StrictMode>
    <BrowserRouter>
      <Routes>
        <Route path="/" element={<App />} />    
        <Route path="/page2" element={<Page2 />} />   
      </Routes> 
    </BrowserRouter>

  </StrictMode>,
)
