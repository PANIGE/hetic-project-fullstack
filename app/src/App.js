import {BrowserRouter} from 'react-router-dom';
import { Routes ,Route } from 'react-router-dom';
import Home from './Composant/home/home';
import Admin from './Composant/admin/admin';
import Err from './Composant/err/err';
import Login from './Composant/login/login';
import Register from './Composant/register/register';
import Report from './Composant/report/report';
import Planing from './Composant/planing/planing';
import './App.css';

function App() {
    return (
        <div className="App">
            <BrowserRouter>
                <Routes>
                    <Route path="/" element={<Home />} />
                    <Route path="/admin" element={<Admin />} />
                    <Route path="/login" element={<Login />} />
                    <Route path="/register" element={<Register />} />
                    <Route path="/report" element={<Report />} />
                    <Route path="/planing" element={<Planing />} />
                    <Route path="/*" element={<Err />} />
                </Routes>
            </BrowserRouter>
        </div>
    );
}

export default App;
