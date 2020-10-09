import React, { Component } from 'react';
import { connect } from 'react-redux';
import {
    fetchCampaignById,
    selectCampaignById
} from '../slices/campaignsSlice';
import RadioQuestion from '../components/RadioQuestion';
import CheckboxQuestion from '../components/CheckboxQuestion';
import TextQuestion from '../components/TextQuestion';

class Campaign extends Component {
    componentDidMount() {
        this.props.fetchCampaignById(6);
    }

    renderQuestion(question) {
        switch (question.type) {
            case 0:
            case 1:
                return <TextQuestion question={question} />;
            case 2:
                return <RadioQuestion question={question} />;
            case 3:
                return <CheckboxQuestion question={question} />;
            case 4:
                return null;
            case 5:
                return null;
            case 6:
                return null;
            default:
                return null;
        }
    }

    render() {
        const { campaign } = this.props;

        return (
            <>
                {campaign &&
                    campaign.questions.map(q => (
                        <React.Fragment key={q.id}>
                            {this.renderQuestion(q)}
                        </React.Fragment>
                    ))}
            </>
        );
    }
}

const mapStateToProps = state => {
    return {
        campaign: selectCampaignById(state, 6)
    };
};

export default connect(mapStateToProps, { fetchCampaignById })(Campaign);
