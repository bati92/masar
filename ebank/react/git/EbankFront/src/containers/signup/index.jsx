import PropTypes from 'prop-types';
import clsx from 'clsx';
import SignupForm from '@components/signup-form';

const SignupArea = ({ className, space }) => (
	<div
		className={clsx(
			'login-area',
			space === 1 && 'rn-section-gapTop_1',
			className
		)}
	>
		<div className="container">
			<div className="row g-5">
				<div className="offset-2 col-lg-12 col-md-12 ml_md--0 ml_sm--0 col-sm-12">
					<SignupForm />
				</div>
			</div>
		</div>
	</div>
);

SignupArea.propTypes = {
	className: PropTypes.string,
	space: PropTypes.oneOf([1])
};

SignupArea.defaultProps = {
	space: 1
};

export default SignupArea;
