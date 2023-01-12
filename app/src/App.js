import { Routes ,Route } from 'react-router-dom';
import Home from './Containers/home/home';
import Admin from './Containers/admin/admin';
import Err from './Containers/err/err';
import Login from './Containers/login/login';
import Register from './Containers/register/register';
import Report from './Containers/report/report';
import Planing from './Containers/planing/planing';
import Navbar from './Containers/other/nav';
import Footer from './Containers/other/footer';
import Transaction from './Containers/transaction/transaction';
import ReportId from './Containers/report/id';
import ReportCreate from './Containers/report/create';
import PlaningId from './Containers/planing/id';
import PlaningCreate from './Containers/planing/create';
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
                <Route path="/report" element={<Report />}>
                    <Route path="/report/:id" element={<ReportId />} />
                    <Route path="/report/create" element={<ReportCreate />} />
                </Route>
                <Route path="/transaction" element={<Transaction />} />
                <Route path="/*" element={<Err />} />
            </Routes>
            <Footer />
        </div>
    );
}

export default App;
