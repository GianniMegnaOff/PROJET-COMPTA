import { TestBed } from '@angular/core/testing';

import { HassidApiService } from './hassid-api.service';

describe('HassidApiService', () => {
  beforeEach(() => TestBed.configureTestingModule({}));

  it('should be created', () => {
    const service: HassidApiService = TestBed.get(HassidApiService);
    expect(service).toBeTruthy();
  });
});
