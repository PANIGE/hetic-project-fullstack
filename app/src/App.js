import { Routes ,Route } from 'react-router-dom';
import Home from './Composant/home/home';
import Admin from './Composant/admin/admin';
import Err from './Composant/err/err';
import Login from './Composant/login/login';
import Register from './Composant/register/register';
import Report from './Composant/report/report';
import Planing from './Composant/planing/planing';
import Navbar from './Composant/other/nav';
import Footer from './Composant/other/footer';
import Transaction from './Composant/transaction/transaction';
import ReportId from './Composant/report/id';
import ReportCreate from './Composant/report/create';
import PlaningId from './Composant/planing/id';
import PlaningCreate from './Composant/planing/create';
import './App.css';

function App() {
    return (
        <div className="App">
            <Navbar />
            <Routes>
                <Route path="/" element={<Home />} />
                <Route path="/admin" element={<Admin />} />
                <Route path="/login" element={<Login />} />
                <Route path="/register" element={<Register />} />
                <Route path="/planing" element={<Planing />}>
                    <Route path="/planing/:id" element={<PlaningId />} />
                    <Route path="/planing/create" element={<PlaningCreate />} />
                </Route>
                <Route path="/*" element={<Err />} />
                <Route path="/report" element={<Report />}>
                    <Route path="/report/:id" element={<ReportId />} />
                    <Route path="/report/create" element={<ReportCreate />} />
                </Route>
                <Route path="/transaction" element={<Transaction />} />
                
            </Routes>
            <Footer />
        </div>
    );
}

export default App;
