import Client from '../src/Http/Client';
import { expect } from 'chai';

describe('XKCD Client', () => {
    it('should return comic id of 1', () => {
        return Client.latestComicId().then((comicId) => {
            expect(comicId).to.eq(1);
        });
    })
});