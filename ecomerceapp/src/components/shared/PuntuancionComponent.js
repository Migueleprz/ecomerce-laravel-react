function PuntuancionComponent(props) {
    const {rating, numReview} = props;
    return (
        <>
            <div className="row">
                <div className="col-sm-12 col-md-6">
                    <div className="rating">
                        <span>
                            <i className={rating >= 1 ? 'fas fa-star text-success' : rating >= 0.5 ? 'fas fa-star-half-stroke text-success' : 'fas fa-star-sharp'}/>
                            <i className={rating >= 2 ? 'fas fa-star text-success' : rating >= 1.5 ? 'fas fa-star-half-stroke text-success' : 'fas fa-star-sharp'}/>
                            <i className={rating >= 3 ? 'fas fa-star text-success' : rating >= 2.5 ? 'fas fa-star-half-stroke text-success' : 'fas fa-star-sharp'}/>
                            <i className={rating >= 4 ? 'fas fa-star text-success' : rating >= 3.5 ? 'fas fa-star-half-stroke text-success' : 'fas fa-star-sharp'}/>
                            <i className={rating >= 5 ? 'fas fa-star text-success' : rating >= 4.5 ? 'fas fa-star-half-stroke text-success' : 'fas fa-star-sharp'}/>
                        </span>

                    </div>
                </div>
                <div className="col-sm-12 col-md-6">
                    <span>Visto: {numReview}</span>
                </div>
            </div>


        </>
    );

}

export default PuntuancionComponent;