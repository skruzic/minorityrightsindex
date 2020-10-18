import React from 'react';
import Typography from '@material-ui/core/Typography';

const CampaignHeader = ({ title }) => (
    <>
        <Typography variant="h3" component="h1">
            {title}
        </Typography>
    </>
);

export default CampaignHeader;
