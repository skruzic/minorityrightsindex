import React from 'react';
import PropTypes from 'prop-types';
import { connect } from 'react-redux';
import Card from '@material-ui/core/Card';
import CardContent from '@material-ui/core/CardContent';
import CardActions from '@material-ui/core/CardActions';
import Button from '@material-ui/core/Button';
import ProgressWithLabel from './ProgressWithLabel';
import {
    saveCampaignAnswers,
    updateVisitedPages
} from '../slices/campaignsSlice';
import { updateInvite } from '../slices/inviteSlice';

const CampaignMessage = ({
    message,
    type,
    nextStep,
    currentStep,
    totalSteps,
    invite,
    //saveFn,
    updateInvite,
    preview,
    updateVisitedPages
}) => {
    const handleNext = () => {
        if (!preview) {
            saveCampaignAnswers({
                invite_id: invite.id,
                page: currentStep
            });
            updateInvite({
                invite_id: invite.id,
                page: currentStep,
                jump: 1,
                direction: 1
            });
        } else {
            updateVisitedPages({
                direction: 1,
                value: currentStep
            });
        }
    };

    return (
        <>
            <ProgressWithLabel
                value={((currentStep - 1) / (totalSteps - 1)) * 100}
            />
            <Card>
                <CardContent dangerouslySetInnerHTML={{ __html: message }} />
                {type === 'intro' && (
                    <CardActions disableSpacing={true}>
                        <Button
                            variant="contained"
                            color="primary"
                            onClick={() => {
                                nextStep();
                                handleNext();
                            }}
                        >
                            Next
                        </Button>
                    </CardActions>
                )}
            </Card>
        </>
    );
};

CampaignMessage.propTypes = {
    message: PropTypes.string,
    type: PropTypes.oneOf(['intro', 'final']).isRequired
};

const mapStateToProps = state => {
    return {
        invite: state.invite.data,
        preview: state.campaign.preview
    };
};

export default connect(mapStateToProps, {
    saveCampaignAnswers,
    updateVisitedPages,
    updateInvite
})(CampaignMessage);
