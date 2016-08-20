///<reference path="../typings/index.d.ts"/>

import Client from '../src/Client';
import { expect } from 'chai';

describe('XKCD Client', () => {
    it('should return comic id of 1', () => {
        return Client.latestComicId().then((comicId) => {
            expect(comicId).to.eq(1);
        });
    })
});