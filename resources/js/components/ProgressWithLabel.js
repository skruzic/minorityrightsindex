import React from 'react';
import PropTypes from 'prop-types';
import Box from '@material-ui/core/Box';
import LinearProgress from '@material-ui/core/LinearProgress';
import Typography from '@material-ui/core/Typography';

const ProgressWithLabel = props => (
    <Box display="flex" alignItems="center">
        <Box width="100%" mr={1}>
            <LinearProgress variant="determinate" {...props} />
        </Box>
        <Box>
            <Typography variant="body2" color="textSecondary">
                {`${Math.round(props.value)}%`}
            </Typography>
        </Box>
    </Box>
);

ProgressWithLabel.propTypes = {
    value: PropTypes.number.isRequired
};

export default ProgressWithLabel;
