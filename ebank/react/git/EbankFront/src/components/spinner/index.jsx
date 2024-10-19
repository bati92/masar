import styles from './LoadingSpinner.module.css';

const LoadingSpinner = () => (
	<div className={styles.spinnerContainer}>
		<div className={styles.spinner} />
	</div>
);

export default LoadingSpinner;
