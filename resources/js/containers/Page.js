import React, { useEffect } from 'react';
import { withStyles } from '@material-ui/core';
import { connect } from 'react-redux';
import { compose } from 'redux';
import querystring from 'query-string';
import { Helmet } from 'react-helmet';
import { fetchPageBySlug } from '../slices/pagesSlice';

const Page = ({
    match: {
        params: { slug }
    },
    fetchPageBySlug,
    pageData
}) => {
    useEffect(() => {
        fetchPageBySlug(slug);
    }, []);

    return (
        <>
            <Helmet>
                <title>{`${pageData.name} :: MinorityRightsIndex.org`}</title>
            </Helmet>
            <div dangerouslySetInnerHTML={{ __html: pageData.content }} />
        </>
    );
};

const styles = {};

const mapStateToProps = state => {
    return {
        pageData: state.page.data
    };
};

export default compose(
    connect(mapStateToProps, { fetchPageBySlug }),
    withStyles(styles)
)(Page);
