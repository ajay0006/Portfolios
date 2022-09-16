import React from "react";
import logo from '../logoAjayi.png';

const Footer = () => (
    <footer className="footer">
        <div>
            <img src={logo} alt="footer logo" className="footer-img"/>
        </div>
        <div>
            <p className="flexP2"> Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                Atque error minima molestiae natus obcaecati omnis possimus provident quod temporibus!
                Architecto asperiores deserunt dignissimos fuga laboriosam maiores provident quam vel
                voluptatum? </p>
        </div>
    </footer>
);

export default Footer;