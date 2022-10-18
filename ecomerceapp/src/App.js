import './App.css';
import {BrowserRouter, Link, Route} from "react-router-dom";
import {Routes} from "react-router";
import HomePage from "./components/HomePage";
import ProductoPage from "./components/ProductoPage";
import Navbar from 'react-bootstrap/Navbar';
import Container from 'react-bootstrap/Container';
import {LinkContainer} from 'react-router-bootstrap';
import {Badge, Nav} from "react-bootstrap";
import {useContext} from "react";
import {Store} from "./core/Store";
import CartPage from "./components/CartPage";
function App() {
    const {state} = useContext(Store);
    const {cart} = state;
  return (
    <BrowserRouter>
        <div className="d-flex flex-column site-c">
            <header>
                <Navbar bg="dark" variant="dark">
                    <Container>
                    <LinkContainer to="/">
                        <Navbar.Brand>Variedades</Navbar.Brand>
                    </LinkContainer>
                        <Nav className="me-auto">
                            <Link to="/cart" className="nav-link" >
                                <i className="fa fa-cart-shopping" />
                                {
                                    cart.cartItems.length > 0 && (
                                        <Badge pill bg="danger">
                                            {cart.cartItems.reduce((sum, calc)=> sum + calc.cant, 0)}
                                        </Badge>
                                    )
                                }
                            </Link>
                        </Nav>
                    </Container>
                </Navbar>
            </header>
            <main>
                <Container>
                    <Routes>
                        <Route  path ="/producto/:id/:slug_nombre" element={<ProductoPage />} />
                        <Route  path ="/cart" element={<CartPage />} />
                        <Route  path ="/" element={<HomePage />} />
                    </Routes>
                </Container>
            </main>
            <footer>
                <h6 className="text-center">Derechos reservados</h6>
            </footer>
        </div>
    </BrowserRouter>
  );
}

export default App;
