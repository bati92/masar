import PropTypes from "prop-types";
import clsx from "clsx";
import Button from "@ui/button";
import ProductTitle from "@components/product-details/title";
import { ImageType } from "@utils/types";
import { getData } from "@utils/getData";

import OrderForm from "@components/order-form/card";
export async function getServerSideProps(context) {
    const data = await getData(`card/${context.query.card_id}`);
    return {
        props: {
            ...data,
        },
    };
}

const ProductDetailsArea = ({ myItems }) => (
    <div className={clsx("product-details-area")}>
        <div className="container">
            <div className="row g-5">
                <div className="col-lg-5 col-md-12 col-sm-12 mt_md--50 mt_sm--60">
                    <div className="rn-pd-content-area">
                        <ProductTitle
                            title={myItems?.card?.name}
                            likeCount={myItems?.card?.likeCount}
                        />
                        <span className="bid">
                            Height bid{" "}
                            <span className="price">
                                {myItems?.card?.price}
                            </span>
                        </span>
                        <h6 className="title-name">{myItems?.card?.note}</h6>

                        <OrderForm app={myItems?.myApp} />
                    </div>
                </div>
            </div>
        </div>
    </div>
);

ProductDetailsArea.propTypes = {
    space: PropTypes.oneOf([1, 2]),
    className: PropTypes.string,
    product: PropTypes.shape({
        title: PropTypes.string.isRequired,
        likeCount: PropTypes.number,
        price: PropTypes.shape({
            amount: PropTypes.number.isRequired,
            currency: PropTypes.string.isRequired,
        }).isRequired,
        owner: PropTypes.shape({}),
        collection: PropTypes.shape({}),
        bids: PropTypes.arrayOf(PropTypes.shape({})),
        properties: PropTypes.arrayOf(PropTypes.shape({})),
        tags: PropTypes.arrayOf(PropTypes.shape({})),
        history: PropTypes.arrayOf(PropTypes.shape({})),
        highest_bid: PropTypes.shape({}),
        auction_date: PropTypes.string,
        images: PropTypes.arrayOf(ImageType),
    }),
};

ProductDetailsArea.defaultProps = {
    space: 1,
};

export default ProductDetailsArea;
