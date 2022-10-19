import {useContext} from "react";
import {Store} from "../core/Store";
import {Helmet} from "react-helmet-async";
import {Col, Image, ListGroup, Row, Button, Card} from "react-bootstrap";
import AlertComponent from "./shared/AlertComponent";
import {Link} from "react-router-dom";
import axios from "axios";
import {useNavigate} from "react-router";

export default function CartPage() {
    const navigate =  useNavigate();
    const {state, dispatch: ctxDispatch} = useContext(Store);
    const { cart: {cartItems}, } = state;
    const upCart = async (item, cant) =>{
       const {data} = await axios.get(`productos/${item.id}`);
        if (cant > data.stock) {
            alert('Lo sentimos. no tenemos esta cantidad');
            return;
        }
        ctxDispatch({type: 'CART_ADD_ITEM', payload: {...item, cant}});
    }
    const removeItem = (item) =>{
        ctxDispatch({type: 'CART_REMOVE_ITEM', payload: {...item}});
    }
    const paymentItem = (item) =>{
       navigate('/signing?redirect=/pedido')
    }

    return (
        <>
            <Helmet><title>Carrito de compra</title></Helmet>
            <Row className={'mt-3'}>
                <Col md={8}>
                    {
                        cartItems.length === 0 ? (
                            <AlertComponent title={'0 Productos agregados'}>
                                <Link to="/">Productos</Link>
                            </AlertComponent>
                        ) : (
                            <ListGroup variant={'flush'}>
                                {
                                    cartItems.map((item) => (
                                        <ListGroup.Item key={item.id} >
                                            <Row className="align-items-center">
                                                <Col md={4}>
                                                    <Link to={`/producto/${item.id}/${item.slug_nombre}`} className={'link-dark nav-link'}>
                                                    <Image
                                                        className="img-fluid rounded img-thumbnail"
                                                        src={item.image_path + item.image}
                                                        alt={item.nombre}
                                                        width={150}
                                                    />

                                                    </Link>
                                                    <span className={'text-capitalize fw-bold'}>{item.nombre}</span>
                                                </Col>
                                                <Col md={3}>
                                                    <Button
                                                        variant={'light'}
                                                        disabled={item.cant === 1}
                                                        onClick={()=> upCart(item, item.cant - 1)}
                                                    >
                                                        <i className={'fa fa-minus-circle fs-3'}/>
                                                    </Button>
                                                    <span className={'h2 mx-3'}>{item.cant}</span>
                                                    <Button
                                                        variant={'light'}
                                                        disabled={item.cant === item.stock}
                                                        onClick={()=> upCart(item, item.cant +1)}
                                                    >
                                                        <i className={'fa fa-plus-circle fs-3'}/>
                                                    </Button>
                                                </Col>
                                                <Col md={3}>
                                                    <span>${item.precio}</span>
                                                </Col>
                                                <Col md={2}>
                                                    <Button
                                                        variant={'light'}
                                                        onClick={()=>removeItem(item)}
                                                    >
                                                        <i className={'fa fa-close fs-3 text-danger'}/>
                                                    </Button>
                                                </Col>
                                            </Row>
                                        </ListGroup.Item>
                                    ))
                                }
                            </ListGroup>
                        )
                    }
                </Col>
                <Col md={4}>
                    <Card>
                        <Card.Body>
                            <ListGroup variant={'flush'}>
                                <ListGroup.Item>
                                    <h4>{cartItems.reduce((sum, cant)=> sum + cant.cant, 0)} Productos  </h4>
                                    <h4>Sub-Total: ${cartItems.reduce((sum, cant)=> sum + cant.precio * cant.cant, 0)} </h4>
                                </ListGroup.Item>
                                <ListGroup.Item>
                                    <Button
                                        variant={'warning'}
                                        type={'button'}
                                        disabled={cartItems.length === 0}
                                        className={'w-100'}
                                        onClick={paymentItem}
                                    >
                                        Pagar <i className={'fa fa-dollar'} />
                                    </Button>
                                </ListGroup.Item>
                            </ListGroup>
                        </Card.Body>
                    </Card>
                </Col>
            </Row>
        </>
    );
}

